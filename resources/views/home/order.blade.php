@extends('layouts.app')

@section('content')
<div style="background-color: #f8f9fa; min-height: 100vh; padding: 2rem 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
        
        <!-- Progress Stepper -->
        <div style="margin-bottom: 3rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
                <!-- Line Background -->
                <div style="position: absolute; top: 20px; left: 0; right: 0; height: 3px; background-color: #e0e0e0; z-index: 0;"></div>
                <div style="position: absolute; top: 20px; left: 0; width: 100%; height: 3px; background-color: #4caf50; z-index: 0;"></div>
                
                <!-- Step 1 - Cart (Completed) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4caf50; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);">✓</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #4caf50;">CART</span>
                </div>
                
                <!-- Step 2 - Payment (Completed) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4caf50; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);">✓</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #4caf50;">PAYMENT</span>
                </div>
                
                <!-- Step 3 - Delivery (Completed) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #4caf50; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(76, 175, 80, 0.3);">✓</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #4caf50;">DELIVERY</span>
                </div>
                
                <!-- Step 4 - Done (Active) -->
                <div style="display: flex; flex-direction: column; align-items: center; z-index: 1;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ff6b6b; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);">4</div>
                    <span style="margin-top: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #ff6b6b;">DONE</span>
                </div>
            </div>
        </div>

        <!-- Header -->
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h2 style="margin: 0 0 0.5rem 0; font-size: 1.75rem; font-weight: 700; color: #333;">My Orders</h2>
            <p style="color: #666; font-size: 0.95rem; margin: 0;">Track and manage all your orders</p>
        </div>

        @if($orders->isEmpty())
            <!-- Empty State -->
            <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 4rem 2rem; text-align: center;">
                <svg style="margin: 0 auto 1.5rem; color: #ddd;" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
                <h4 style="margin: 0 0 0.5rem 0; font-size: 1.25rem; font-weight: 600; color: #666;">No Orders Yet</h4>
                <p style="color: #999; margin: 0 0 1.5rem 0;">You haven't placed any orders yet. Start shopping!</p>
                <a href="{{ route('home.index') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); color: white; text-decoration: none; border-radius: 2rem; font-weight: 600; box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3); transition: all 0.3s;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        @else
            <!-- Orders List -->
            @foreach ($orders as $order)
                <div style="background-color: white; border-radius: 1rem; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 2rem; margin-bottom: 1.5rem;">
                    
                    <!-- Order Header -->
                    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; margin-bottom: 1.5rem; border-bottom: 2px solid #f0f0f0;">
                        <div>
                            <h4 style="margin: 0 0 0.25rem 0; font-size: 1.125rem; font-weight: 700; color: #333;">Order #{{ $order->id }}</h4>
                            <p style="margin: 0; font-size: 0.875rem; color: #999;">
                                <svg style="display: inline-block; vertical-align: middle; margin-right: 0.25rem;" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 0.75rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.25rem;">Total Amount</div>
                            <div style="font-size: 1.5rem; font-weight: 700; color: #ff6b6b;">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <!-- Order Info Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                        
                        <!-- Customer Info -->
                        <div>
                            <div style="font-size: 0.75rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; font-weight: 600;">Customer</div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span style="color: #333; font-weight: 600;">{{ $order->user->name ?? 'Unknown' }}</span>
                            </div>
                        </div>

                        <!-- Tracking Number -->
                        <div>
                            <div style="font-size: 0.75rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; font-weight: 600;">Tracking Number</div>
                            @if($order->resi)
                                <a href="https://cekresi.com/?resi={{ $order->resi }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background-color: #e3f2fd; color: #1976d2; text-decoration: none; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; transition: all 0.2s;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                        <polyline points="15 3 21 3 21 9"></polyline>
                                        <line x1="10" y1="14" x2="21" y2="3"></line>
                                    </svg>
                                    {{ $order->resi }}
                                </a>
                            @else
                                <span style="color: #999; font-style: italic;">Not available yet</span>
                            @endif
                        </div>

                        <!-- Delivery Address -->
                        <div>
                            <div style="font-size: 0.75rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; font-weight: 600;">Delivery Address</div>
                            <div style="display: flex; align-items: start; gap: 0.5rem;">
                                <svg style="flex-shrink: 0; margin-top: 2px;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span style="color: #666; line-height: 1.5; font-size: 0.875rem;">{{ $order->address }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Products List -->
                    <div style="background-color: #f8f9fa; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                        <div style="font-size: 0.75rem; color: #999; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 1rem; font-weight: 600;">Order Items</div>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            @foreach ($order->orderItems as $item)
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; background-color: white; border-radius: 0.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 8px; height: 8px; background-color: #ff6b6b; border-radius: 50%;"></div>
                                        @if ($item->product)
                                            <span style="color: #333; font-weight: 600;">{{ $item->product->name }}</span>
                                            <span style="color: #999; font-size: 0.875rem;">× {{ $item->quantity }}</span>
                                            @if($item->product->is_premium)
                                                <span style="padding: 0.25rem 0.5rem; background-color: #ffd93d; color: #333; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">PREMIUM</span>
                                            @endif
                                        @else
                                            <span style="color: #999; font-style: italic;">Unknown item</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Status & Actions -->
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                        
                        <!-- Status Badges -->
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                            <!-- Payment Status -->
                            <div>
                                <div style="font-size: 0.75rem; color: #999; margin-bottom: 0.375rem;">Payment</div>
                                <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 1rem; border-radius: 2rem; font-weight: 600; font-size: 0.875rem; 
                                    {{ $order->payment_status == 'paid' ? 'background-color: #d4edda; color: #155724;' : 
                                       ($order->payment_status == 'failed' ? 'background-color: #f8d7da; color: #721c24;' : 'background-color: #fff3cd; color: #856404;') }}">
                                    @if($order->payment_status == 'paid')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @endif
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>

                            <!-- Order Status -->
                            <div>
                                <div style="font-size: 0.75rem; color: #999; margin-bottom: 0.375rem;">Order Status</div>
                                <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 1rem; border-radius: 2rem; font-weight: 600; font-size: 0.875rem;
                                    {{ $order->status == 'completed' ? 'background-color: #d4edda; color: #155724;' : 
                                       ($order->status == 'shipped' ? 'background-color: #cfe2ff; color: #084298;' : 'background-color: #e2e3e5; color: #383d41;') }}">
                                    @if($order->status == 'completed')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    @elseif($order->status == 'shipped')
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="1" y="3" width="15" height="13"></rect>
                                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                        </svg>
                                    @endif
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                            @if($order->payment_status == 'unpaid')
                                <form action="{{ route('payment.proses', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.5rem; background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%); color: white; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: pointer; box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3); transition: all 0.2s;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                        </svg>
                                        Pay Now
                                    </button>
                                </form>
                            @else
                                <button disabled style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.5rem; background-color: #d4edda; color: #155724; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: not-allowed; opacity: 0.7;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                    Paid
                                </button>
                            @endif

                            @if ($order->status !== 'accepted')
                                <form action="{{ route('orders.destroy.home', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cancel-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.5rem; background-color: white; color: #666; border: 1px solid #ddd; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                        </svg>
                                        Cancel Order
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            @endforeach
        @endif

        <!-- Back to Home Link -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('home.index') }}" style="color: #666; text-decoration: none; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.5rem; transition: color 0.2s;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Back to Home
            </a>
        </div>

    </div>
</div>

<style>
/* Button Hover Effects */
.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(255, 107, 107, 0.4) !important;
}

.action-btn:active {
    transform: translateY(0);
}

.cancel-btn:hover {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}

/* Link Hover */
a:hover {
    color: #ff6b6b !important;
}

a[href*="cekresi"]:hover {
    background-color: #1976d2 !important;
    color: white !important;
}

/* Responsive */
@media (max-width: 768px) {
    div[style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
    }
    
    div[style*="display: flex"] {
        flex-direction: column;
        align-items: flex-start !important;
    }
}

/* Smooth transitions */
* {
    transition: background-color 0.2s, color 0.2s, transform 0.2s;
}
</style>
@endsection