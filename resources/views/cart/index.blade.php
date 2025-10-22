@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        <!-- Progress Stepper -->
        <div style="margin-bottom: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
                <!-- Line Background -->
                <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background-color: #e0e0e0; z-index: 0;"></div>
                <div style="position: absolute; top: 20px; left: 0; width: 0%; height: 3px; background-color: #ff6b6b; z-index: 0;"></div>
                
                <!-- Step 1 - Cart (Active) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ff6b6b; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);">1</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #ff6b6b;">CART</span>
                </div>
                
                <!-- Step 2 - Payment -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ffd93d; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">2</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500; color: #999;">PAYMENT</span>
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

        <!-- Cart Content -->
        <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem;">
            
            <!-- Header with Select All -->
            <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 2px solid #f0f0f0; margin-bottom: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <input type="checkbox" id="selectAll" style="width: 20px; height: 20px; cursor: pointer; accent-color: #ff6b6b;">
                    <label for="selectAll" style="margin: 0; font-weight: 600; color: #333; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer;">SELECT ALL</label>
                </div>
                <div style="display: flex; gap: 8rem;">
                    <h5 style="margin: 0; font-weight: 600; color: #333; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">PRICE</h5>
                    <h5 style="margin: 0; font-weight: 600; color: #333; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">QUANTITY</h5>
                    <h5 style="margin: 0; font-weight: 600; color: #333; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.5px;">TOTAL</h5>
                </div>
            </div>

            <!-- Cart Items -->
            <form action="{{ route('checkout.selected') }}" method="POST" id="cartForm">
                @csrf
                
                @foreach ($cartItems as $item)
                    @php
                        $product = $item->product;
                        $variant = $item->variant;
                        $price = $product?->price ?? 0;
                        $name = $product?->name ?? 'Produk tidak ditemukan';
                        $image = $product?->image ?? 'images/default.jpg';
                        $size = $variant?->size ?? '-';
                        $color = $variant?->color ?? '-';
                        $subtotal = $item->quantity * $price;
                    @endphp

                    <div class="cart-item" style="display: flex; align-items: center; justify-content: space-between; padding: 1.5rem 0; border-bottom: 1px solid #f5f5f5;">
                        
                        <!-- Checkbox -->
                        <div style="width: 50px; display: flex; justify-content: center;">
                            <input type="checkbox" class="item-checkbox" name="selected_items[]" value="{{ $item->id }}" data-subtotal="{{ $subtotal }}" data-item-id="{{ $item->id }}" style="width: 20px; height: 20px; cursor: pointer; accent-color: #ff6b6b;">
                        </div>

                        <!-- Item Info -->
                        <div style="display: flex; align-items: center; gap: 1.5rem; flex: 1;">
                            <!-- Image -->
                            <div style="width: 100px; height: 100px; border-radius: 0.75rem; overflow: hidden; background-color: #f8f9fa; flex-shrink: 0;">
                                <img src="/images/{{ $image }}" alt="{{ $name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            
                            <!-- Product Details -->
                            <div style="flex: 1;">
                                <h6 style="margin: 0 0 0.5rem 0; font-weight: 600; color: #333; font-size: 1rem;">{{ $name }}</h6>
                                <div style="display: flex; gap: 1rem; align-items: center;">
                                    <span style="font-size: 0.875rem; color: #666;">SIZE <span style="color: #333; font-weight: 600;">{{ $size }}</span></span>
                                    <span style="font-size: 0.875rem; color: #666;">COLOR <span style="display: inline-block; width: 12px; height: 12px; border-radius: 50%; background-color: {{ strtolower($color) == 'merah' ? '#e74c3c' : (strtolower($color) == 'biru' ? '#3498db' : (strtolower($color) == 'hijau' ? '#2ecc71' : '#95a5a6')) }}; vertical-align: middle; margin-left: 4px; border: 2px solid white; box-shadow: 0 0 0 1px #ddd;"></span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div style="width: 120px; text-align: center;">
                            <span style="font-weight: 600; color: #333; font-size: 1rem;">Rp {{ number_format($price, 0, ',', '.') }}</span>
                        </div>

                        <!-- Quantity Controls -->
                        <div style="width: 150px; display: flex; align-items: center; justify-content: center;">
                            <button type="button" class="decrease-qty" data-item-id="{{ $item->id }}" style="width: 32px; height: 32px; border: 1px solid #ddd; background-color: white; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #666; font-size: 1.25rem; transition: all 0.2s;">-</button>
                            <input type="number" name="quantity[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="quantity-input" data-item-id="{{ $item->id }}" data-price="{{ $price }}" style="width: 50px; height: 32px; text-align: center; border: 1px solid #ddd; border-left: none; border-right: none; margin: 0; font-weight: 600; color: #333; font-size: 0.95rem;" readonly>
                            <button type="button" class="increase-qty" data-item-id="{{ $item->id }}" style="width: 32px; height: 32px; border: 1px solid #ddd; background-color: white; border-radius: 4px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #666; font-size: 1.25rem; transition: all 0.2s;">+</button>
                        </div>

                        <!-- Subtotal -->
                        <div style="width: 130px; text-align: center;">
                            <span class="item-subtotal" data-item-id="{{ $item->id }}" style="font-weight: 700; color: #333; font-size: 1.1rem;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>

                        <!-- Delete Button -->
                        <div style="width: 40px; text-align: center;">
                            <button type="button" class="delete-item" data-item-id="{{ $item->id }}" style="width: 32px; height: 32px; border: none; background-color: transparent; cursor: pointer; color: #999; font-size: 1.25rem; transition: all 0.2s; border-radius: 4px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach

                <!-- Footer Section -->
                <div style="margin-top: 3rem; display: flex; justify-content: space-between; align-items: center;">
                    
                    <!-- Promo Code (Left) -->
                    <div style="flex: 1; max-width: 400px;">
                        {{-- <div style="display: flex; gap: 0.5rem;">
                            <input type="text" placeholder="PROMO CODE" id="promoCode" style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 0.5rem; font-size: 0.875rem; color: #333;">
                            <button type="button" id="applyPromo" style="padding: 0.75rem 1.5rem; background-color: white; border: 1px solid #ddd; border-radius: 0.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4caf50" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                        </div> --}}
                        <div id="promoMessage" style="margin-top: 0.5rem; font-size: 0.813rem; color: #4caf50; display: none;"></div>
                    </div>

                    <!-- Totals (Right) -->
                    <div style="text-align: right;">
                        <div style="margin-bottom: 1rem;">
                            <span style="font-size: 0.875rem; color: #666; text-transform: uppercase; letter-spacing: 0.5px;">DISCOUNT</span>
                            <span id="discountAmount" style="font-size: 1.5rem; font-weight: 700; color: #333; margin-left: 2rem;">Rp 0</span>
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <span style="font-size: 0.875rem; color: #666; text-transform: uppercase; letter-spacing: 0.5px;">TOTAL</span>
                            <span id="totalAmount" style="font-size: 1.5rem; font-weight: 700; color: #333; margin-left: 2rem;">Rp 0</span>
                        </div>
                        <button type="submit" id="checkoutBtn" style="padding: 0.875rem 3rem; background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); color: white; border: none; border-radius: 2rem; font-weight: 600; font-size: 1rem; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3); transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px;">
                            CHECK OUT
                        </button>
                    </div>
                </div>

            </form>

        </div>

        <!-- Continue Shopping Link -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('home.index') }}" style="color: #666; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.2s;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Jelajah
            </a>
        </div>

    </div>
</div>

<!-- JavaScript for Cart Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let discount = 0;
    const selectAllCheckbox = document.getElementById('selectAll');
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');
    const checkoutBtn = document.getElementById('checkoutBtn');
    
    // Select All functionality
    selectAllCheckbox.addEventListener('change', function() {
        itemCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        calculateTotal();
    });
    
    // Individual checkbox change
    itemCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Update select all checkbox state
            const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
            calculateTotal();
        });
    });
    
    // Calculate total based on selected items
    function calculateTotal() {
        let total = 0;
        let hasSelectedItems = false;
        
        itemCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                hasSelectedItems = true;
                const subtotal = parseFloat(checkbox.dataset.subtotal);
                total += subtotal;
            }
        });
        
        const finalTotal = total - discount;
        document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        
        // Enable/disable checkout button based on selection
        checkoutBtn.disabled = !hasSelectedItems;
        if (!hasSelectedItems) {
            checkoutBtn.style.opacity = '0.5';
            checkoutBtn.style.cursor = 'not-allowed';
        } else {
            checkoutBtn.style.opacity = '1';
            checkoutBtn.style.cursor = 'pointer';
        }
        
        return total;
    }
    
    // Update item subtotal
    function updateItemSubtotal(itemId) {
        const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
        const quantity = parseInt(input.value);
        const price = parseFloat(input.dataset.price);
        const subtotal = quantity * price;
        
        // Update subtotal display
        document.querySelector(`.item-subtotal[data-item-id="${itemId}"]`).textContent = 
            'Rp ' + subtotal.toLocaleString('id-ID');
        
        // Update checkbox data-subtotal
        const checkbox = document.querySelector(`.item-checkbox[data-item-id="${itemId}"]`);
        checkbox.dataset.subtotal = subtotal;
        
        calculateTotal();
    }
    
    // Increase quantity
    document.querySelectorAll('.increase-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            input.value = parseInt(input.value) + 1;
            updateItemSubtotal(itemId);
            
            // Update to server
            updateQuantityOnServer(itemId, input.value);
        });
    });
    
    // Decrease quantity
    document.querySelectorAll('.decrease-qty').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateItemSubtotal(itemId);
                
                // Update to server
                updateQuantityOnServer(itemId, input.value);
            }
        });
    });
    
    // Delete item
    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            if (confirm('Hapus produk dari keranjang?')) {
                deleteItemFromCart(itemId);
            }
        });
    });
    
    // Promo code
    document.getElementById('applyPromo').addEventListener('click', function() {
        const promoCode = document.getElementById('promoCode').value.trim();
        const promoMessage = document.getElementById('promoMessage');
        
        if (promoCode === '') {
            promoMessage.style.display = 'block';
            promoMessage.style.color = '#f44336';
            promoMessage.textContent = 'Masukkan kode promo';
            return;
        }
        
        // Simulate promo code validation
        if (promoCode.toLowerCase() === 'discount50k') {
            discount = 50000;
            promoMessage.style.display = 'block';
            promoMessage.style.color = '#4caf50';
            promoMessage.textContent = '✓ Kode promo berhasil diterapkan!';
            document.getElementById('discountAmount').textContent = 'Rp ' + discount.toLocaleString('id-ID');
            calculateTotal();
        } else {
            promoMessage.style.display = 'block';
            promoMessage.style.color = '#f44336';
            promoMessage.textContent = 'Kode promo tidak valid';
            discount = 0;
            document.getElementById('discountAmount').textContent = 'Rp 0';
            calculateTotal();
        }
    });
    
    // Form submit validation
    document.getElementById('cartForm').addEventListener('submit', function(e) {
        const hasSelectedItems = Array.from(itemCheckboxes).some(cb => cb.checked);
        if (!hasSelectedItems) {
            e.preventDefault();
            alert('Pilih minimal satu item untuk checkout!');
        }
    });
    
    // Update quantity on server
    function updateQuantityOnServer(itemId, quantity) {
        fetch(`/cart/update/${itemId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Gagal update quantity');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Delete item from cart
    function deleteItemFromCart(itemId) {
        fetch(`/cart/delete/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus item');
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // Hover effects
    document.querySelectorAll('.increase-qty, .decrease-qty').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f5f5f5';
            this.style.borderColor = '#999';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'white';
            this.style.borderColor = '#ddd';
        });
    });
    
    document.querySelectorAll('.delete-item').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#ffebee';
            this.style.color = '#f44336';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
            this.style.color = '#999';
        });
    });
    
    // Initial calculation
    calculateTotal();
});
</script>

<style>
/* Additional hover effects */
button[type="submit"]:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(255, 107, 107, 0.4) !important;
}

button[type="submit"]:active:not(:disabled) {
    transform: translateY(0);
}

#applyPromo:hover {
    background-color: #f5f5f5;
    border-color: #4caf50;
}

.cart-item:last-child {
    border-bottom: none !important;
}
</style>
@endsection