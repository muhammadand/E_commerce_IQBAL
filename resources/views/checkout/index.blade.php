@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        <!-- Progress Stepper -->
        <div style="margin-bottom: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
                <!-- Line Background -->
                <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background-color: #e0e0e0; z-index: 0;"></div>
                <div style="position: absolute; top: 20px; left: 0; width: 33%; height: 3px; background-color: #ff6b6b; z-index: 0;"></div>
                
                <!-- Step 1 - Cart -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4caf50; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">✓</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">CART</span>
                </div>
                
                <!-- Step 2 - Payment (Active) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ff6b6b; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);">2</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #ff6b6b;">PAYMENT</span>
                </div>
                
                <!-- Step 3 - Delivery -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ffd93d; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">3</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">DELIVERY</span>
                </div>
                
                <!-- Step 4 - Done -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ffd93d; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">4</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">DONE</span>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; border: 1px solid #f5c6cb;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Main Content -->
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">
            
            <!-- Left Column - Billing Details -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem;">
                <h3 style="margin: 0 0 1.5rem 0; font-size: 1.5rem; font-weight: 600; color: #333;">Billing Details</h3>
                
                <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" id="checkout-form">
                    @csrf
                    
                    <!-- Customer Name -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">CUSTOMER NAME</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name ?? '' }}" readonly
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; background-color: #f8f9fa; color: #666; font-size: 0.95rem;">
                    </div>

                    <!-- Check Ongkir -->
                    <div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #f8f9fa; border-radius: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; color: #333; font-size: 0.875rem;">CHECK SHIPPING COST</span>
                        <a href="{{ route('ongkir.index') }}" style="padding: 0.5rem 1.5rem; background-color: white; border: 1px solid #ddd; border-radius: 0.5rem; color: #333; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: all 0.2s;">
                            Click Here
                        </a>
                    </div>

                    <!-- Address -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">ADDRESS</label>
                        <textarea name="address" id="address" rows="4" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; resize: vertical;">{{ Auth::user()->alamat }}</textarea>
                    </div>

                    <!-- Note -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">NOTE (OPTIONAL)</label>
                        <textarea name="note" id="note" rows="3"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; resize: vertical;" placeholder="Add delivery notes..."></textarea>
                    </div>

                    <!-- Payment Method -->
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">PAYMENT METHOD</label>
                        <select name="payment_method" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; cursor: pointer;">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div>
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem; position: sticky; top: 2rem;">
                    
                    <h3 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; font-weight: 600; color: #333;">Order Summary</h3>
                    <p style="margin: 0 0 2rem 0; font-size: 0.875rem; color: #999;">Review your items before checkout</p>
                    
                    <!-- Items List -->
                    <div style="border-top: 2px solid #f0f0f0; padding-top: 1.5rem; margin-bottom: 1.5rem;">
                        @foreach ($cartItems->filter(fn($item) => $selectedItems->contains($item->id)) as $item)
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                <div style="flex: 1;">
                                    @if ($item->product)
                                        <span style="font-size: 0.875rem; color: #666;">{{ $item->quantity }}x</span>
                                        <span style="font-size: 0.95rem; color: #333; margin-left: 0.5rem;">{{ $item->product->name }}</span>
                                    @else
                                        <span style="color: #f44336; font-size: 0.875rem;">Item not found</span>
                                    @endif
                                </div>
                                <div style="font-weight: 600; color: #333;">
                                    @if ($item->product)
                                        @if ($item->product->discount && $item->product->discount->status === 'active')
                                            Rp{{ number_format($item->product->discount->final_price * $item->quantity, 0, ',', '.') }}
                                        @else
                                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                        @endif
                                    @else
                                        Rp0
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Points Slider -->
                    <div style="padding: 1rem; background-color: #f8f9fa; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">USE POINTS: {{ Auth::user()->points }}</label>
                        <input type="range" id="points" name="points" min="0"
                            max="{{ Auth::user()->points }}" step="1" value="0"
                            style="width: 100%; margin: 0.5rem 0; accent-color: #ff6b6b;">
                        <p style="margin: 0; font-size: 0.875rem; color: #666;">Using: <span id="points-value" style="font-weight: 600; color: #ff6b6b;">0</span> Points</p>
                    </div>

                    @php
                        $total = $cartItems
                            ->filter(fn($item) => $selectedItems->contains($item->id))
                            ->sum(function ($item) {
                                if ($item->product) {
                                    if ($item->product->discount && $item->product->discount->status === 'active') {
                                        return $item->product->discount->final_price * $item->quantity;
                                    }
                                    return $item->product->price * $item->quantity;
                                }
                                return 0;
                            });
                        $ongkirCost = session('ongkir')['cost'] ?? 0;

                        $voucher = session('applied_voucher');
                        $voucherDiscount = 0;

                        if ($voucher) {
                            if ($voucher['discount_type'] === 'percent') {
                                $voucherDiscount = ($total + $ongkirCost) * ($voucher['discount_value'] / 100);
                            } else {
                                $voucherDiscount = $voucher['discount_value'];
                            }
                        }

                        $discountedTotal = max($total + $ongkirCost - $voucherDiscount, 0);
                    @endphp

                    <!-- Cost Breakdown -->
                    <div style="border-top: 1px solid #f0f0f0; padding-top: 1rem; margin-bottom: 1rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="font-size: 0.875rem; color: #666;">Subtotal</span>
                            <span style="font-weight: 600; color: #333;">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span style="font-size: 0.875rem; color: #666;">Shippingg</span>
                            <span style="font-weight: 600; color: #333;">Rp{{ number_format($ongkirCost, 0, ',', '.') }}</span>
                        </div>
                        @if ($voucher)
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                                <span style="font-size: 0.875rem; color: #4caf50;">Voucher ({{ $voucher['code'] }})</span>
                                <span style="font-weight: 600; color: #4caf50;">- Rp{{ number_format($voucherDiscount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Total -->
                    <div style="border-top: 2px solid #f0f0f0; padding-top: 1rem; margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-size: 1rem; font-weight: 600; color: #333; text-transform: uppercase; letter-spacing: 0.5px;">Total</span>
                            <span id="discounted-total" style="font-size: 1.5rem; font-weight: 700; color: #333;">Rp{{ number_format($discountedTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <input type="hidden" id="points-used" name="points_used" value="0">
                    <input type="hidden" id="discounted_total" name="discounted_total" value="{{ $discountedTotal }}">

                    <!-- Place Order Button -->
                    <button type="submit" style="width: 100%; padding: 0.875rem; background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); color: white; border: none; border-radius: 2rem; font-weight: 600; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3); transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 1rem;">
                        PLACE ORDER
                    </button>
                    </form>

                    <!-- Voucher Form -->
                    <form action="{{ route('order.applyVoucher') }}" method="POST">
                        @csrf
                        <div style="display: flex; gap: 0.5rem;">
                            @php
                                $lastUsedCode = session('last_applied_voucher_code');
                            @endphp
                            
                            <select name="voucher_code" required style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.875rem; background-color: #f8f9fa;">
                                <option value="">-- Select Voucher --</option>
                                @foreach ($availableVouchers as $v)
                                    <option value="{{ $v->code }}" {{ $lastUsedCode === $v->code ? 'selected' : '' }}>
                                        {{ $v->code }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <button type="submit" style="padding: 0.75rem 1.5rem; background-color: #b80989; color: white; border: none; border-radius: 0.5rem; cursor: pointer; font-size: 0.875rem; font-weight: 600; transition: all 0.2s; white-space: nowrap;">
                                APPLY
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        <!-- Back to Cart Link -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('cart.index') }}" style="color: #666; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.2s;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Cart
            </a>
        </div>

    </div>
</div>

<script>
    let totalPrice = {{ $total }};
    let pointsUsed = 0;
    let pointsAvailable = {{ Auth::user()->points }};
    let shippingCost = {{ $ongkirCost }};
    let voucherDiscount = {{ $voucherDiscount ?? 0 }};

    function calculateDiscountedPrice() {
        let discountedPrice = totalPrice + shippingCost - pointsUsed - voucherDiscount;
        if (discountedPrice < 0) discountedPrice = 0;
        document.getElementById("discounted-total").textContent = 'Rp' + discountedPrice.toLocaleString('id-ID');
        document.getElementById("discounted_total").value = discountedPrice;
    }

    document.getElementById("points").addEventListener("input", function() {
        pointsUsed = parseInt(this.value);
        document.getElementById("points-value").textContent = pointsUsed;
        document.getElementById("points-used").value = pointsUsed;
        calculateDiscountedPrice();
    });

    calculateDiscountedPrice();
</script>

<style>
/* Hover effects */
button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 107, 107, 0.4) !important;
}

button[type="submit"]:active {
    transform: translateY(0);
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus,
select:focus {
    outline: none;
    border-color: #ff6b6b;
    box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
}

@media (max-width: 992px) {
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
}
</style>
@endsection