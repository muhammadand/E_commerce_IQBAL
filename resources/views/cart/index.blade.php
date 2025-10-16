@extends('layouts.app')
@section('content')

    {{-- <div class="section">
        <div class="container">
            <div class="section-title overflow-hidden mb-4">
        <h3 class="d-flex align-items-center">Cart</h3>
    </div> --}}

    <div class="col-md-12">

        <div class="card card-round">
            @if (session('success'))
            <!-- Modal -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: white; color: black;">
                        <div class="modal-header" style="border-bottom: 1px solid #ccc;">
                            <h5 class="modal-title" id="successModalLabel">Success</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="font-size: 16px;">
                            {{ session('success') }}
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid #ccc;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
            <script>
                // Ensure that the modal is displayed automatically when the page loads
                window.addEventListener('load', function() {
                    var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                        keyboard: false
                    });
                    myModal.show();
                });
            </script>
        @endif
        
        

            <div class="card-body p-0">
                @if ($cartItems->isEmpty())
                    <!-- Empty Cart Message -->
                    <div style="text-align: center; padding: 20px;">
                        <p style="color: #888; font-size: 16px;">Your cart is empty.</p>
                    </div>





                    <section id="latest-products" class="product-store py-2 my-2 py-md-5 my-md-5 pt-0">
                        <div class="container-md">
                            <div class="display-header d-flex align-items-center justify-content-between">
                                <h2 class="section-title text-uppercase">recommended products</h2>
                                {{-- <div class="btn-right">
                                    <a href="index.html" class="d-inline-block text-uppercase text-hover fw-bold">View all</a>
                                </div> --}}
                            </div>
                            <div class="product-content padding-small">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                                    @foreach ($recommendedProducts->take(5) as $product)
                                        <div class="col mb-4">
                                            <div class="product-card position-relative">
                                                <div class="card-img">
                                                    <img src="/images/{{ $product->image }}" alt="product-item"
                                                        class="product-image img-fluid">
                                                    <div
                                                        class="cart-concern position-absolute d-flex justify-content-center">
                                                        <div
                                                            class="cart-button d-flex gap-2 justify-content-center align-items-center">


                                                            <!-- Form Tambah ke Cart -->
                                                            <form action="{{ route('cart.store') }}" method="POST"
                                                                onsubmit="addToCartSuccess()" style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <input type="hidden" name="quantity" value="1">

                                                                @if ($product->discount && $product->discount->status === 'active')
                                                                    <input type="hidden" name="price"
                                                                        value="{{ $product->discount->final_price }}">
                                                                @else
                                                                    <input type="hidden" name="price"
                                                                        value="{{ $product->price }}">
                                                                @endif

                                                                <button type="submit" class="btn btn-light">
                                                                    <svg class="shopping-carriage">
                                                                        <use xlink:href="#shopping-carriage"></use>
                                                                    </svg>
                                                                </button>
                                                            </form>

                                                            <!-- Form Tambah ke Wishlist (icon love) -->
                                                            <form action="{{ route('wishlist.add', $product->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                <button type="submit" class="btn btn-light">
                                                                    <i class="far fa-heart" style="color: black;"></i>

                                                                </button>
                                                            </form>

                                                            <!-- Tombol Quick View -->
                                                            <button type="button" class="btn btn-light"
                                                                onclick="window.location.href='{{ route('detail', $product->id) }}'">
                                                                <svg class="quick-view">
                                                                    <use xlink:href="#quick-view"></use>
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <!-- cart-concern -->
                                                </div>
                                                <div
                                                    class="card-detail d-flex justify-content-between align-items-center mt-3">
                                                    <h3 class="card-title fs-6 fw-normal m-0"
                                                        style="word-wrap: break-word; word-break: break-all; white-space: normal;">
                                                        <a href="index.html"
                                                            style="display: block; word-wrap: break-word; word-break: break-all;">
                                                            {{ $product->name }}
                                                        </a>
                                                    </h3>



                                                    @if ($product->discount && $product->discount->status === 'active')
                                                        <span class="card-price fw-bold text-muted">
                                                            <del>Rp{{ number_format($product->price, 0, ',', '.') }}</del>
                                                        </span>
                                                        <span class="card-price fw-bold text-danger">
                                                            Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                                                        </span>
                                                    @else
                                                        <span class="card-price fw-bold">
                                                            Rp{{ number_format($product->price, 0, ',', '.') }}
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </section>
                @else
                <div class="container mt-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Cart</h3>
                    </div>
                
                    <div class="row justify-content-center">
                        @foreach ($cartItems as $index => $item)
                            <div class="col-md-10 mb-3">
                                <div class="card border-0 shadow rounded-4">
                                    <div class="card-body d-flex flex-column flex-md-row align-items-center gap-3">
                                        <div>
                                            <img src="/images/{{ $item->product->image }}"
                                                 alt="{{ $item->product->name }}"
                                                 class="rounded-3"
                                                 style="width: 80px; height: 80px; object-fit: cover;">
                                        </div>
                
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ $item->product->name }}</h5>
                                            <p class="mb-1">
                                                @if ($item->product->discount && $item->product->discount->status === 'active')
                                                    <span class="text-muted"><del>Rp{{ number_format($item->product->price, 0, ',', '.') }}</del></span><br>
                                                    <span class="text-danger fw-semibold">Rp{{ number_format($item->product->discount->final_price, 0, ',', '.') }}</span>
                                                @else
                                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                                @endif
                                            </p>
                
                                            <div class="d-flex justify-content-between mt-2">
                                                <span class="fw-medium">Subtotal:</span>
                                                <span class="fw-bold">
                                                    @if ($item->product->discount && $item->product->discount->status === 'active')
                                                        Rp{{ number_format($item->product->discount->final_price * $item->quantity, 0, ',', '.') }}
                                                    @else
                                                        Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                
                                        <div class="d-flex flex-column gap-2 align-items-end">
                                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                       class="form-control form-control-sm" style="width: 60px;">
                                                <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                            </form>
                
                                            <form action="{{ route('cart.delete') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @endif

            </div>
        </div>
        {{-- </div>
        </div> --}}
    </div>
@endsection
