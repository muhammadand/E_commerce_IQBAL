@extends('layouts.app')

@section('content')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <style>
        .banner-slide {
            position: relative;
            width: 100%;
            height: 450px;
            overflow: hidden;
            border-radius: 1rem;
        }

        .banner-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .banner-content {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            color: white;
            z-index: 2;
            max-width: 600px;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .banner-title {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .banner-description {
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }

        .banner-btn {
            display: inline-block;
            margin-top: 1.2rem;
            padding: 0.7rem 1.5rem;
            background-color: #ffffff;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            text-decoration: none;
        }

        .swiper-pagination-bullet-active {
            background-color: #000 !important;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #fff;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 22px;
            font-weight: bold;
        }
    </style>

    <section id="intro" class="position-relative mt-4">
        <div class="container-lg">
            <div class="swiper main-swiper">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <div class="banner-slide">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->name }}">
                                <div class="banner-overlay"></div>
                                <div class="banner-content">
                                    <h2 class="banner-title text-white">{{ $banner->name }}</h2>

                                    @if ($banner->discount_amount)
                                        <p class="mt-2">
                                            <span class="badge bg-danger">
                                                Diskon {{ rtrim(rtrim($banner->discount_amount, '0'), '.') }}%
                                            </span>
                                        </p>
                                    @endif
                                    <a href="{{ route('user.store') }}" class="banner-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigasi & Pagination -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination mt-3"></div>
            </div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.main-swiper', {
            loop: {{ count($banners) > 1 ? 'true' : 'false' }},
            grabCursor: true,
            autoplay: false, // Tidak autoplay
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            speed: 600,
        });
    </script>

    <section class="discount-coupon py-4 my-5">
        <div class="container">
            <div
                style="background-color: #fce4ec; border-radius: 1.5rem; padding: 2.5rem; position: relative; overflow: hidden;">
                {{-- Watermark Besar --}}
                <div
                    style="position: absolute; top: 10px; right: 20px; font-size: 4rem; font-weight: bold; color: rgba(255, 64, 129, 0.1); z-index: 0;">
                    {{ $biggestDiscount ? $biggestDiscount->discount_value . ($biggestDiscount->discount_type === 'percent' ? '%' : ' Rp') . ' OFF' : 'PROMO' }}
                </div>

                {{-- Konten --}}
                <div class="row justify-content-between align-items-center position-relative" style="z-index: 1;">
                    <div class="col-lg-8 col-md-12 mb-3">
                        <div class="coupon-header">
                            <h2 class="fw-bold mb-3" style="font-size: 1.8rem; color: #c2185b;">
                                {{ $biggestDiscount ? $biggestDiscount->promo_name : 'Dapatkan Diskon Spesial Hari Ini!' }}
                            </h2>
                            <p class="mb-0" style="font-size: 1rem; color: #333;">
                                @if ($biggestDiscount)
                                    Nikmati diskon untuk <strong>{{ $biggestDiscount->product->name }}</strong>,
                                    sekarang hanya
                                    <strong>Rp{{ number_format($biggestDiscount->calculated_final_price) }}</strong>!
                                @else
                                    Daftar email sekarang dan dapatkan <strong>10% OFF</strong> untuk semua pembelian!
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 text-md-start text-lg-end">
                        <a href="{{ $biggestDiscount ? route('detail', $biggestDiscount->product->id) : '#' }}"
                            class="btn"
                            style="background-color: #ec407a; color: white; border-radius: 50px; padding: 0.7rem 1.5rem; font-weight: 600;">
                            {{ $biggestDiscount ? 'Lihat Produk' : 'Daftar Sekarang' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="featured-products" class="product-store py-5" style="background-color: #fff0f5;">
        <div class="container-md">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="text-uppercase fw-bold" style="color: #ad1457;">Produk Unggulan</h2>
                <a href="{{ route('user.store') }}" class="text-uppercase fw-semibold text-decoration-none"
                    style="color: #ec407a;">
                    Lihat Semua
                </a>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
                @foreach ($featuredProduct->take(5) as $product)
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="position-relative">
                                <img src="/images/{{ $product->image }}" alt="{{ $product->name }}"
                                    class="card-img-top rounded-top-4" style="object-fit: cover; height: 180px;">

                                {{-- Tombol Hover --}}
                                <div class="position-absolute top-0 end-0 p-2 d-flex gap-1">
                                    {{-- Wishlist --}}
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm">
                                            <i class="far fa-heart" style="color: #ec407a;"></i>
                                        </button>
                                    </form>

                                    {{-- Quick View --}}
                                    <button type="button" class="btn btn-light btn-sm rounded-circle shadow-sm"
                                        onclick="window.location.href='{{ route('detail', $product->id) }}'">
                                        <i class="fas fa-eye" style="color: #ad1457;"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <h5 class="card-title mb-2" style="font-size: 15px; color: #333;">{{ $product->name }}</h5>

                                @if ($product->discount && $product->discount->status === 'active')
                                    <div class="mb-2">
                                        <del
                                            class="text-muted small">Rp{{ number_format($product->price, 0, ',', '.') }}</del><br>
                                        <span
                                            class="text-danger fw-semibold">Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <span
                                            class="text-dark fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                {{-- Tombol Cart --}}
                                <form action="{{ route('cart.store') }}" method="POST" onsubmit="addToCartSuccess()">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="price"
                                        value="{{ $product->discount && $product->discount->status === 'active' ? $product->discount->final_price : $product->price }}">

                                    <button type="submit" class="btn btn-pink w-100 rounded-pill mt-2 fw-bold"
                                        style="background-color: #ec407a; color: white;">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="collection-products" class="py-2 my-2 py-md-5 my-md-5" style="background-color: #fff0f5;">
        <div class="container-md">
            <div class="row g-4">
                <div class="col-lg-6 col-md-6">
                    <div
                        class="collection-card card border-0 shadow-sm d-flex flex-row align-items-end bg-light rounded-4 overflow-hidden">
                        <img src="https://cdn0-production-images-kly.akamaized.net/QcML9whEW7RHVNjhEMagQu2P3KU=/800x450/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3932177/original/049434000_1644677080-All_creations.JPG"
                            alt="Kue Spesial" class="img-fluid w-50" style="object-fit: cover; height: 300px;">
                        <div class="card-detail p-4">
                            <h3 class="card-title fs-3 fw-bold text-dark">
                                <a href="#" class="text-decoration-none" style="color: #d81b60;">Kue Spesial</a>
                            </h3>
                            <p class="text-muted mt-1">Rasakan manisnya setiap gigitan kue homemade dari Asha Kitchen.</p>
                            <a href="{{ route('user.store') }}"
                                class="text-uppercase mt-2 d-inline-block fw-bold text-decoration-none"
                                style="color: #ec407a;">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div
                        class="collection-card card border-0 shadow-sm d-flex flex-row align-items-end bg-light rounded-4 overflow-hidden">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS77NQt2YD84gebT72ZMrxSoiX4RXmSESk4J3hk6-hnf8H7ivdnW90JS-Zfz_b1cr4NZy8&usqp=CAU"
                            alt="Bolu Lembut" class="img-fluid w-50" style="object-fit: cover; height: 300px;">
                        <div class="card-detail p-4">
                            <h3 class="card-title fs-3 fw-bold text-dark">
                                <a href="#" class="text-decoration-none" style="color: #d81b60;">Bolu Lembut</a>
                            </h3>
                            <p class="text-muted mt-1">Bolu lembut dan wangi yang cocok untuk acara spesial kamu.</p>
                            <a href="{{ route('user.store') }}"
                                class="text-uppercase mt-2 d-inline-block fw-bold text-decoration-none"
                                style="color: #ec407a;">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="latest-products" class="product-store py-2 my-2 py-md-5 my-md-5 pt-0"
        style="background-color: #fff0f5;">
        <div class="container-md">
            <div class="display-header d-flex align-items-center justify-content-between">
                <h2 class="section-title text-uppercase fw-bold" style="color: #ec407a;">Produk Terbaru</h2>
            </div>
            <div class="product-content padding-small">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
                    @foreach ($products as $product)
                        <div class="col mb-4">
                            <div class="product-card position-relative">
                                <div class="card-img">
                                    <img src="/images/{{ $product->image }}" alt="product-item" class="img-fluid"
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
                                                        ? $product->discount->final_price
                                                        : $product->price }}">

                                                <button type="submit" class="btn btn-light shadow-sm">
                                                    <i class="fas fa-cart-shopping" style="color: #ec407a;"></i>
                                                </button>

                                            </form>

                                            <!-- Form Tambah ke Wishlist -->
                                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-light shadow-sm">
                                                    <i class="far fa-heart" style="color: #ec407a;"></i>
                                                </button>
                                            </form>

                                            <!-- Tombol Quick View -->
                                            <button type="button" class="btn btn-light shadow-sm"
                                                onclick="window.location.href='{{ route('detail', $product->id) }}'">
                                                <i class="fas fa-eye" style="color: #ec407a;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-detail d-flex justify-content-between align-items-center mt-3">
                                    <h3 style="font-size: 16px; letter-spacing: 0.5px;">
                                        <a href="#"
                                            style="color: #333; text-decoration: none;">{{ $product->name }}</a>
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
