@extends('layouts.app')

@section('content')
{{-- Hero Kategori --}}



    <section class="category-hero py-4" style="background-color: #fce4ec; border-radius: 1rem; margin-bottom: 2rem;">
        <div class="container text-center">
            <h2 class="fw-bold mb-2" style="color: #d81b60; font-size: 28px;">
                Kategori: {{ $category->name }}
            </h2>
            <p class="text-muted mb-0" style="font-size: 14px;">
                Temukan berbagai pilihan produk terbaik dalam kategori <strong>{{ $category->name }}</strong>.
            </p>
        </div>
    </section>
    <section id="latest-products" class="product-store py-2 my-2 py-md-5 my-md-5 pt-0" style="background-color: #fff0f5;">
        <div class="container-md">
            <div class="display-header d-flex align-items-center justify-content-between">
                <h2 class="section-title text-uppercase fw-bold" style="color: #ec407a;">
                    Produk Kategori: {{ $category->name }}
                </h2>
            </div>
            <div class="product-content padding-small">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                    @foreach ($products as $product)
                        <div class="col mb-4">
                            <div class="product-card position-relative">
                                <div class="card-img">
                                    <img src="/images/{{ $product->image }}" alt="{{ $product->name }}"
                                         class="img-fluid"
                                         style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px;">
    
                                    <div class="cart-concern position-absolute d-flex justify-content-center">
                                        <div class="cart-button d-flex gap-2 justify-content-center align-items-center">
                                            <!-- Form Tambah ke Cart -->
                                            <form action="{{ route('cart.store') }}" method="POST"
                                                  onsubmit="addToCartSuccess()" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price"
                                                       value="{{ $product->discount && $product->discount->status === 'active'
                                                                   ? $product->discount->final_price : $product->price }}">
    
                                                <button type="submit" class="btn btn-light shadow-sm">
                                                    <i class="fas fa-cart-shopping" style="color: #ec407a;"></i>
                                                </button>
                                            </form>
    
                                            <!-- Wishlist -->
                                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light shadow-sm">
                                                    <i class="far fa-heart" style="color: #ec407a;"></i>
                                                </button>
                                            </form>
    
                                            <!-- Quick View -->
                                            <button type="button" class="btn btn-light shadow-sm"
                                                    onclick="window.location.href='{{ route('detail', $product->id) }}'">
                                                <i class="fas fa-eye" style="color: #ec407a;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                                    <h3 style="font-size: 16px; letter-spacing: 0.5px;">
                                        <a href="#" style="color: #333; text-decoration: none;">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    @if ($product->discount && $product->discount->status === 'active')
                                        <span class="card-price fw-bold text-muted">
                                            <del>Rp{{ number_format($product->price, 0, ',', '.') }}</del>
                                        </span>
                                        <span class="card-price fw-bold" style="color: #d81b60;">
                                            Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="card-price fw-bold text-dark">
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
    

@endsection
