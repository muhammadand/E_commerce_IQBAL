<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Menambah produk ke wishlist
    public function add($id)
    {
        $user = Auth::user();

        // Cek apakah produk sudah ada di wishlist user
        $existing = Wishlist::where('user_id', $user->id)
                            ->where('product_id', $id)
                            ->first();

        if ($existing) {
            return back()->with('info', 'Produk sudah ada di wishlist Anda.');
        }

        Wishlist::create([
            'user_id' => $user->id,
            'product_id' => $id,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke wishlist.');
    }
    // Menghapus produk dari wishlist
    public function removeFromWishlist($productId)
{
    // Pastikan pengguna terautentikasi
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors('Anda harus login untuk menghapus produk dari wishlist.');
    }

    // Cek apakah produk ada di wishlist pengguna
    $wishlist = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();

    if (!$wishlist) {
        return back()->withErrors('Produk tidak ditemukan di wishlist Anda.');
    }

    // Menghapus produk dari wishlist
    $wishlist->delete();

    return back()->with('success', 'Produk berhasil dihapus dari wishlist.');
}


    // Menampilkan wishlist pengguna
    public function index()
    {
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->paginate(10);

        return view('wishlist.index', compact('wishlists'));
    }
}
