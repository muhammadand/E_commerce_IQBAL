@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        <!-- Progress Stepper -->
        <div style="margin-bottom: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
                <!-- Line Background -->
                <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background-color: #e0e0e0; z-index: 0;"></div>
                <div style="position: absolute; top: 20px; left: 0; width: 33.33%; height: 3px; background-color: #ff6b6b; z-index: 0;"></div>
                
                <!-- Step 1 - Cart (Completed) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4caf50; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);">✓</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #4caf50;">CART</span>
                </div>
                
                <!-- Step 2 - Payment (Active) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ff6b6b; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);">2</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #ff6b6b;">PAYMENT</span>
                </div>
                
                <!-- Step 3 - Delivery -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">3</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">DELIVERY</span>
                </div>
                
                <!-- Step 4 - Done -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">4</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">DONE</span>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        @if (session('success'))
            <div style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" id="checkout-form">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                
                <!-- Left Column - Billing Details -->
                <div>
                    <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 2rem;">
                        <h3 style="margin: 0 0 1.5rem 0; font-size: 1.5rem; font-weight: 700; color: #333;">Billing Details</h3>
                        
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">Customer Name</label>
                            <input type="text" value="{{ auth()->user()->name ?? '' }}" readonly style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; background-color: #f8f9fa; color: #666; font-size: 0.95rem;">
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">Delivery Address</label>
                            <textarea name="address" id="address" rows="4" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; resize: vertical;">{{ Auth::user()->alamat }}</textarea>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">Order Notes (Optional)</label>
                            <textarea name="note" id="note" rows="3" placeholder="Special instructions for your order..." style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; resize: vertical;"></textarea>
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">Payment Method</label>
                            <select name="payment_method" required style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; cursor: pointer;">
                                <option value="">Select payment method</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="e_wallet">E-Wallet</option>
                            </select>
                        </div>

                        <div style="background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 0.5rem; padding: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#856404" stroke-width="2">
                                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12.01" y2="17"></line>
                            </svg>
                            <div>
                                <strong style="color: #856404; font-size: 0.875rem;">Check Shipping Cost</strong>
                                <a href="{{ route('ongkir.index') }}" style="margin-left: 0.5rem; color: #ff6b6b; text-decoration: none; font-weight: 600;">Click Here</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div>
                    <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem; position: sticky; top: 2rem;">
                        <h3 style="margin: 0 0 0.5rem 0; font-size: 1.5rem; font-weight: 700; color: #333; text-align: center;">Order Summary</h3>
                        <p style="text-align: center; color: #666; font-size: 0.875rem; margin-bottom: 1.5rem;">Review your items before checkout</p>
                        
                        <!-- Order Items -->
                        <div style="max-height: 300px; overflow-y: auto; margin-bottom: 1.5rem; padding-right: 0.5rem;">
                            @foreach ($cartItems->filter(fn($item) => $selectedItems->contains($item->id)) as $item)
                                <div style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid #f0f0f0;">
                                    <div style="flex: 1;">
                                        @if ($item->product)
                                            <div style="font-weight: 600; color: #333; margin-bottom: 0.25rem;">
                                                {{ $item->quantity }}x {{ $item->product->name }}
                                            </div>
                                            
                                            @php
                                                $attributes = json_decode($item->attributes, true);
                                            @endphp

                                            @if ($attributes)
                                                <div style="font-size: 0.813rem; color: #666;">
                                                    @foreach ($attributes as $key => $value)
                                                        <span>{{ ucfirst($key) }}: {{ $value['name'] }}</span>
                                                        @if (!empty($value['price']) && $value['price'] > 0)
                                                            <span style="color: #4caf50;">(+Rp{{ number_format($value['price'], 0, ',', '.') }})</span>
                                                        @endif
                                                        @if (!$loop->last) | @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        @else
                                            <span style="color: #f44336;">Item not found</span>
                                        @endif
                                    </div>
                                    <div style="font-weight: 700; color: #333; white-space: nowrap; margin-left: 1rem;">
                                        Rp{{ number_format($item->total_price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Points Slider -->
                        <div style="background-color: #f8f9fa; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem;">
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #333; font-size: 0.875rem;">
                                Use Points (Available: {{ Auth::user()->points }})
                            </label>
                            <input type="range" id="points" name="points" min="0" max="{{ Auth::user()->points }}" step="1" value="0" style="width: 100%; margin: 0.5rem 0; accent-color: #ff6b6b;">
                            <div style="text-align: center; font-weight: 600; color: #ff6b6b; font-size: 1rem;">
                                Using: <span id="points-value">0</span> Points
                            </div>
                        </div>

                        @php
                            $total = $cartItems->filter(fn($item) => $selectedItems->contains($item->id))->sum(fn($item) => $item->quantity * $item->total_price);
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

                        <!-- Price Breakdown -->
                        <div style="border-top: 2px solid #f0f0f0; padding-top: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; color: #666;">
                                <span>Subtotal</span>
                                <span style="font-weight: 600;">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; color: #666;">
                                <span>Shipping</span>
                                <span style="font-weight: 600;">Rp{{ number_format($ongkirCost, 0, ',', '.') }}</span>
                            </div>

                            @if ($voucher)
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; color: #4caf50;">
                                    <span>Voucher ({{ $voucher['code'] }})</span>
                                    <span style="font-weight: 600;">- Rp{{ number_format($voucherDiscount, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <div style="display: flex; justify-content: space-between; margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #f0f0f0; font-size: 1.25rem; font-weight: 700; color: #333;">
                                <span>Total</span>
                                <span id="discounted-total">Rp{{ number_format($discountedTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <input type="hidden" id="points-used" name="points_used" value="0">
                        <input type="hidden" id="discounted_total" name="discounted_total" value="{{ $discountedTotal }}">

                        <!-- Voucher Section -->
                        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 2px solid #f0f0f0;">
                            <h4 style="margin: 0 0 1rem 0; font-size: 1rem; font-weight: 600; color: #333;">Apply Voucher</h4>
                            <div style="display: flex; gap: 0.5rem;">
                                <select name="voucher_code" style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.95rem; cursor: pointer;">
                                    <option value="">Select Voucher</option>
                                    @php
                                        $lastUsedCode = session('last_applied_voucher_code');
                                    @endphp
                                    @foreach ($availableVouchers as $v)
                                        <option value="{{ $v->code }}" {{ $lastUsedCode === $v->code ? 'selected' : '' }}>
                                            {{ $v->code }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="applyVoucher()" style="padding: 0.75rem 1.5rem; background-color: #ffd93d; color: #333; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" style="width: 100%; margin-top: 1.5rem; padding: 1rem; background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); color: white; border: none; border-radius: 2rem; font-weight: 700; font-size: 1.1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3); transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px;">
                            Place Order
                        </button>
                    </div>
                </div>

            </div>
        </form>

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

<!-- JavaScript -->
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

    function applyVoucher() {
        const voucherSelect = document.querySelector('select[name="voucher_code"]');
        const voucherCode = voucherSelect.value;
        
        if (!voucherCode) {
            alert('Please select a voucher');
            return;
        }

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("order.applyVoucher") }}';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        
        const voucherInput = document.createElement('input');
        voucherInput.type = 'hidden';
        voucherInput.name = 'voucher_code';
        voucherInput.value = voucherCode;
        
        form.appendChild(csrfInput);
        form.appendChild(voucherInput);
        document.body.appendChild(form);
        form.submit();
    }

    calculateDiscountedPrice();
</script>

<style>
button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 107, 107, 0.4) !important;
}

button[type="submit"]:active {
    transform: translateY(0);
}

button[type="button"]:hover {
    background-color: #ffc107 !important;
}

/* Custom scrollbar for order items */
div[style*="overflow-y: auto"]::-webkit-scrollbar {
    width: 6px;
}

div[style*="overflow-y: auto"]::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
    background: #ff6b6b;
    border-radius: 10px;
}

div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb:hover {
    background: #ff5252;
}

@media (max-width: 768px) {
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="position: sticky"] {
        position: relative !important;
        top: 0 !important;
    }
}
</style>
@endsection