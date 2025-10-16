<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Category;
use App\Models\Voucher;
use Illuminate\Support\Facades\Http;  
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{


    //percobaan
    public function selected(Request $request)
    {
        $selectedIds = $request->input('selected_items', []);
        $selectedItems = Cart::with(['product']) // Hanya ambil produk, tanpa bundle
            ->whereIn('id', $selectedIds)
            ->get();
        
        session(['selected_checkout_items' => $selectedItems]);
    
        return redirect()->route('checkout.index');
    }
    
    

    public function index()
{
    $biggestDiscount = Discount::where('status', 'active')
        ->with('product')
        ->get()
        ->sortByDesc(function ($discount) {
            return $discount->calculated_final_price;
        })
        ->first();

    $userId = Auth::id(); 
    $cartItems = Cart::where('user_id', $userId)->with('product')->get();
    $categories = Category::all();
    $user = Auth::user();

    $wishlistItems = [];
    if ($user) {
        $wishlistItems = \App\Models\Wishlist::with('product')
            ->where('user_id', $user->id)
            ->get();
    }



    $selectedItems = session('selected_checkout_items', collect());

    // Ambil semua voucher aktif yang belum melebihi batas penggunaan 2 kali untuk user ini
    $availableVouchers = Voucher::where('is_active', true)
        ->where(function ($query) use ($user) {
            $query->whereDoesntHave('users', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->where('usage_count', '>=', 2);
            });
        })
        ->get();

    return view('checkout.index', compact(
        'cartItems',
        'categories',
      
        'selectedItems',
        'wishlistItems',
        'biggestDiscount',
        'availableVouchers' // <- ini tambahan penting
    ));
}


public function process(Request $request)
{
    $userId = Auth::id();
    $user = Auth::user();

    // Ambil item yang dipilih
    $selectedItems = session('selected_checkout_items', collect())->pluck('id');
    $cartItems = Cart::where('user_id', $userId)
        ->with(['product'])
        ->get()
        ->filter(fn($item) => $selectedItems->contains($item->id));

    // Validasi input form
    $request->validate([
        'address' => 'required|string|max:255',
        'payment_method' => 'required|string|max:50',
        'note' => 'nullable|string|max:500',
    ]);

    // Handle gambar jika ada
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    // Total & poin dari request
    $totalSetelahDiskon = (int) $request->input('discounted_total');
    $poinDipakai = (int) $request->input('points_used');
    $shippingCost = session('ongkir')['cost'] ?? 0;

    // Hitung total cart
    $totalDariCart = $cartItems->sum(function ($item) {
        if ($item->product) {
            if ($item->product->discount && $item->product->discount->status === 'active') {
                return $item->product->discount->final_price * $item->quantity;
            }
            return $item->product->price * $item->quantity;
        }
        return 0;
    });

    $voucher = null;
$voucherDiscount = 0;
$voucherCode = null;

if (session()->has('applied_voucher')) {
    $voucherSession = session('applied_voucher');
    
    // Ambil data voucher asli dari database untuk keamanan
    $voucher = \App\Models\Voucher::where('code', $voucherSession['code'])->first();

    if ($voucher && $voucher->is_active && (!$voucher->expires_at || $voucher->expires_at >= now())) {
        $voucherCode = $voucher->code;

        if ($voucher->discount_type === 'percent') {
            $voucherDiscount = ($totalDariCart + $shippingCost) * ($voucher->discount_value / 100);
        } else {
            $voucherDiscount = $voucher->discount_value;
        }

        // Hindari diskon lebih besar dari subtotal
        $voucherDiscount = min($voucherDiscount, $totalDariCart + $shippingCost);
    }
}

    // Hitung total akhir
    $totalHarusnya = $totalDariCart + $shippingCost - $poinDipakai - $voucherDiscount;
    if ($totalHarusnya < 0) $totalHarusnya = 0;

    // Validasi total
    if ($totalSetelahDiskon != round($totalHarusnya)) {
        return redirect()->back()->withErrors('Total tidak valid. Silakan coba lagi.');
    }
 
    // Validasi poin cukup
    if ($poinDipakai > $user->points) {
        return redirect()->back()->withErrors('Poin tidak mencukupi.');
    }

    // Buat order
    $order = Order::create([
        'user_id' => $userId,
        'address' => $request->input('address'),
        'payment_method' => $request->input('payment_method'),
        'total' => $totalSetelahDiskon,
        'shipping_cost' => $shippingCost,
        'image' => $imagePath,
        'status' => 'pending',
        'payment_status' => 'unpaid',
        'note' => $request->input('note'),
        'voucher_code' => $voucherCode,
        'voucher_discount_amount' => $voucherDiscount,
    ]);

    // Simpan item ke order_items
    foreach ($cartItems as $item) {
        if ($item->product) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Update stok produk
            $product = Product::find($item->product_id);
            if ($product) {
                $product->stock -= $item->quantity;
                $product->save();
            }
        }
    }

    // Kurangi poin user
    if ($poinDipakai > 0) {
        $user->points -= $poinDipakai;
         /** @var \App\Models\User $user */
        $user->save();
    }

    // Kosongkan cart
    Cart::where('user_id', $userId)
        ->whereIn('id', $selectedItems)
        ->delete();

    // Bersihkan session
    session()->forget('ongkir');
    session()->forget('applied_voucher');
    session()->forget('selected_checkout_items');

    return redirect()->route('home.order')->with('success', 'Order berhasil dibuat!');
}



    // public function ongkir_index()
    // {
    //     $selectedItems = session('selected_checkout_items', collect());
    
    //     // Hitung total berat: setiap quantity × 1000 gram
    //     $totalWeight = $selectedItems->sum(function ($item) {
    //         return $item->quantity * 1000;
    //     });
    
    //     $categories = Category::all();
    //     $cities = $this->getCities();
    
    //     return view('checkout.ongkir', compact('cities', 'categories', 'selectedItems', 'totalWeight'));
    // }
    
    
    //end percobaan
    public function ongkir_index()
    {
        $biggestDiscount = Discount::where('status', 'active')
        ->with('product')
        ->get()
        ->sortByDesc(function ($discount) {
            return $discount->calculated_final_price;
        })
        ->first();
        $userId = Auth::id(); // Menggunakan Auth Facade untuk mendapatkan user ID
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $user = Auth::user();
    
        // Ambil wishlist milik user (jika login)
        $wishlistItems = [];
        if ($user) {
            $wishlistItems = \App\Models\Wishlist::with('product')
                ->where('user_id', $user->id)
                ->get();
        }
        // Ambil daftar kota untuk ditampilkan di form
        $categories = Category::all();
        $cities = $this->getCities();
         // Hitung total berat: setiap quantity × 1000 gram
         $selectedItems = session('selected_checkout_items', collect());
         $totalWeight = $selectedItems->sum(function ($item) {
            return $item->quantity * 1000;
        });
        return view('checkout.ongkir', compact('cities','categories','userId','cartItems','wishlistItems','biggestDiscount','totalWeight'));
    }

    public function cekOngkir(Request $request)
    {   

        $user = Auth::user();
        $biggestDiscount = Discount::where('status', 'active')
        ->with('product')
        ->get()
        ->sortByDesc(function ($discount) {
            return $discount->calculated_final_price;
        })
        ->first();
        // Ambil wishlist milik user (jika login)
        $wishlistItems = [];
        if ($user) {
            $wishlistItems = \App\Models\Wishlist::with('product')
                ->where('user_id', $user->id)
                ->get();
        }
        
        
        $userId = Auth::id(); // Menggunakan Auth Facade untuk mendapatkan user ID
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        
        $categories = Category::all();
        $rajaongkirKey = '8f22875183c8c65879ef1ed0615d3371';
        $origin = 211; // ID Kota asal
        $destination = $request->input('destination');
        $weight = $request->input('weight');
        $courier = $request->input('courier');

        $client = new Client();

        $response = $client->request('POST', 'https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => $rajaongkirKey,
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier,
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            return view('checkout.result', compact('result','categories','userId','cartItems','wishlistItems','biggestDiscount'));
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil ongkir!');
        }
    }

    public function saveOngkir(Request $request)
    {
        // Menyimpan pilihan ongkir ke session
        session([
            'ongkir' => [
                'courier' => $request->input('courier'),
                'service' => $request->input('service'),
                'cost' => $request->input('cost'),
                'etd' => $request->input('etd'),
            ]
        ]);
    

        
        // Redirect ke halaman checkout.index setelah berhasil disimpan
        return redirect()->route('checkout.index')->with('success', 'Ongkir berhasil disimpan.');
    }
    
    

    public function getCities()
    {
        $rajaongkirKey = '8f22875183c8c65879ef1ed0615d3371';
        $client = new Client();

        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => $rajaongkirKey,
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            $result = json_decode($response->getBody()->getContents(), true);
            return $result['rajaongkir']['results'];
        } else {
            return [];
        }
    }

  
    

  
}
