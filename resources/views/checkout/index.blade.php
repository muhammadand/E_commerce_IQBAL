@extends('layouts.app')
@section('content')
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <!-- SECTION -->
    <div class="section" style="padding: 20px 0; font-family: sans-serif;">
        <h2 style="font-size: 28px; font-weight: 600; margin-bottom: 20px; text-align: center;">
            Checkout Your Order
        </h2>
        <p style="text-align: center; font-size: 14px; color: #666; margin-bottom: 30px;">
            Complete your details and ensure the address and payment method information are correct before finalizing your
            order.
        </p>

        <div class="container" style="max-width: 1200px; margin: auto;">
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">

                <!-- Input Alamat -->
                <div class="col-md-7" style="flex: 1; min-width: 300px;">
                    <div class="billing-details" style="padding: 20px; border: 1px solid #eee; border-radius: 8px;">
                        <div class="section-title" style="margin-bottom: 20px;">
                            <h3 class="title" style="margin: 0; font-size: 20px;">Input Address</h3>
                        </div>

                        <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data"
                            id="checkout-form">
                            @csrf
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px;">Name Customers</label>
                                <input type="text" class="form-control" value="{{ auth()->user()->name ?? '' }}" readonly
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                            </div>

                            <div
                                style="border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 10px; font-weight: bold; display: flex; justify-content: space-between;">
                                <div>Check Ongkir</div>
                                <div> <a href="{{ route('ongkir.index') }}"
                                        class="btn btn-outline-gray hvr-sweep-to-right dark-sweep">Click Here</a></div>
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px;">Address</label>
                                <textarea name="address" id="address" rows="4" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ Auth::user()->alamat }}</textarea>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px;" for="note">Keterangan</label>
                                <textarea name="note" id="note" rows="4" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
                            </div>

                            <div style="margin-bottom: 15px;">
                                <label style="display: block; margin-bottom: 5px;">Payment Method</label>
                                <select name="payment_method" required
                                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="e_wallet">E-Wallet</option>
                                </select>
                            </div>
                    </div>
                </div>

                <!-- Ringkasan Order -->
                <div class="col-md-5" style="flex: 1; min-width: 280px;">
                    <div class="order-details" style="padding: 20px; border: 1px solid #eee; border-radius: 8px;">
                        <div style="text-align: center; margin-bottom: 30px;">
                            <h2 style="margin: 0; font-size: 26px; font-weight: bold; color: #333;">
                                Ringkasan Pesanan Anda
                            </h2>
                            <p style="font-size: 14px; color: #777;">Periksa kembali item sebelum checkout</p>
                        </div>
                        

                        <div
                            style="border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 10px; font-weight: bold; display: flex; justify-content: space-between;">
                            <div>PRODUCT</div>
                            <div>TOTAL</div>
                        </div>

                        @foreach ($cartItems->filter(fn($item) => $selectedItems->contains($item->id)) as $item)
                            <div style="margin-bottom: 8px; display: flex; justify-content: space-between;">
                                <div>
                                    @if ($item->product)
                                        {{ $item->quantity }}x {{ $item->product->name }}
                                    @else
                                        <span class="text-danger">Item tidak ditemukan</span>
                                    @endif
                                </div>

                                <div>
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

                        <div style="margin-top: 20px;">
                            <label for="points">Gunakan Poin: {{ Auth::user()->points }}</label>
                            <input type="range" id="points" name="points" min="0"
                                max="{{ Auth::user()->points }}" step="1" value="0"
                                style="width: 100%; margin: 5px 0;">
                            <p style="margin: 0;">Gunakan Poin: <span id="points-value">0</span> Poin</p>
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

                            // Voucher logic start
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
                            // Voucher logic end
                        @endphp

                        <div style="margin-top: 20px; display: flex; justify-content: space-between; font-weight: bold;">
                            <div>Ongkir</div>
                            <div>Rp.{{ number_format($ongkirCost, 0, ',', '.') }}</div>
                        </div>

                        @if ($voucher)
                            <div style="margin-top: 10px; display: flex; justify-content: space-between;">
                                <div>Voucher ({{ $voucher['code'] }})</div>
                                <div>- Rp{{ number_format($voucherDiscount, 0, ',', '.') }}</div>
                            </div>
                        @endif

                        <div style="margin-top: 10px; display: flex; justify-content: space-between; font-weight: bold;">
                            <div>TOTAL</div>
                            <div>Rp.{{ number_format($total + $ongkirCost, 0, ',', '.') }}</div>
                        </div>

                        <div style="margin-top: 10px; display: flex; justify-content: space-between; font-weight: bold;">
                            <div>DISCOUNTED TOTAL</div>
                            <div id="discounted-total">Rp{{ number_format($discountedTotal, 0, ',', '.') }}</div>
                        </div>

                        <input type="hidden" id="points-used" name="points_used" value="0">
                        <input type="hidden" id="discounted_total" name="discounted_total" value="{{ $discountedTotal }}">

                 <button type="submit" class="btn btn-dark btn-lg rounded-pill px-4 shadow">
  <i class="bi bi-bag-check-fill me-2"></i> Place Order
</button>

                        </form>

                        {{-- Form Voucher --}}
                        <form action="{{ route('order.applyVoucher') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="input-group">
                                @php
                                    $lastUsedCode = session('last_applied_voucher_code');
                                @endphp
                            
                                <select name="voucher_code" class="form-select border-dark text-dark" style="background-color: #f8f9fa;" required>
                                    <option value="">-- Pilih Voucher --</option>
                                    @foreach ($availableVouchers as $v)
                                        <option value="{{ $v->code }}"
                                            {{ $lastUsedCode === $v->code ? 'selected' : '' }}>
                                            {{ $v->code }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                <button type="submit" class="btn" style="background-color: #b80989; color: #fff;">
                                    <i class="bi bi-ticket-fill me-1"></i> Gunakan
                                </button>
                            </div>
                            
                        </form>
                    </div>
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
    </div>
@endsection
