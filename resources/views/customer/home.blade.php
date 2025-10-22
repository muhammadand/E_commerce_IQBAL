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

    {{-- <section id="intro" class="position-relative mt-4">
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
    </section> --}}

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

    <section id="new-arrivals" class="new-arrivals">
        <div class="container">
            <div class="section-header">
                <h2>Produk Utama</h2>
            </div><!--/.section-header-->

            <div class="new-arrivals-content">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-sm-4">
                            <div class="single-new-arrival">
                                <div class="single-new-arrival-bg">
                                    <img src="/images/{{ $product->image }}" alt="{{ $product->name }}">

                                    <div class="single-new-arrival-bg-overlay"></div>

                                    {{-- Label kategori / diskon --}}
                                    @if ($product->discount && $product->discount->status === 'active')
                                        <div class="sale bg-1">
                                            <p>Promo</p>
                                        </div>
                                    @else
                                        <div class="sale bg-2">
                                            <p>Regular</p>
                                        </div>
                                    @endif

                                   <div class="new-arrival-cart m-2" style="display: flex; justify-content: space-between; align-items: center;">
    <div style="display: flex; align-items: center; gap: 8px;">
        {{-- Tambah ke cart --}}
        <form action="{{ route('cart.store') }}" method="POST" onsubmit="addToCartSuccess()" style="display:inline;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="price"
                value="{{ $product->discount && $product->discount->status === 'active'
                    ? $product->discount->final_price
                    : $product->price }}">
            <button type="submit"
                style="background:none; border:none; color:inherit; padding:0; margin:0; cursor:pointer;">
                <span class="lnr lnr-cart" style="font-size: 18px; color: #fafafa;"></span>
            </button>
        </form>
    </div>

    <div style="display: flex; align-items: center; gap: 10px;">
        {{-- Wishlist --}}
        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; padding:0; margin:0; cursor:pointer;">
                <span class="lnr lnr-heart" style="font-size: 18px; color: #fafafa;"></span>
            </button>
        </form>

        {{-- Lihat detail --}}
        <a href="{{ route('detail', $product->id) }}" style="color: #fafafa;">
            <span class="lnr lnr-frame-expand" style="font-size: 18px;"></span>
        </a>
    </div>
</div>

                                </div>

                                <h4>
                                    <a href="{{ route('detail', $product->id) }}">{{ $product->name }}</a>
                                </h4>

                                @if ($product->discount && $product->discount->status === 'active')
                                    <p class="arrival-product-price">
                                        <del>Rp{{ number_format($product->price, 0, ',', '.') }}</del><br>
                                        Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="arrival-product-price">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!--/.container-->
    </section><!--/.new-arrivals-->
    <!--new-arrivals end -->



<section class="discount-coupon py-5" style="background-color: #f9f9f9;">
    <div class="container">
        <div class="promo-banner position-relative overflow-hidden" 
            style="background: linear-gradient(90deg, #111 0%, #333 100%);
                   color: #fff; padding: 4rem 3rem; box-shadow: 0 8px 25px rgba(0,0,0,0.15);">

            <!-- Watermark -->
            <div style="position: absolute; top: 10%; right: 5%; font-size: 8rem; 
                        font-weight: 900; color: rgba(255,255,255,0.05); z-index: 0; text-transform: uppercase;">
                {{ $biggestDiscount ? ($biggestDiscount->discount_value . ($biggestDiscount->discount_type === 'percent' ? '%' : ' Rp') . ' OFF') : 'PROMO' }}
            </div>

            <!-- Konten -->
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8 col-md-12 mb-4 mb-lg-0">
                    <h1 class="fw-bold mb-3" style="font-size: 2.5rem; line-height: 1.2;">
                        {{ $biggestDiscount ? $biggestDiscount->promo_name : 'Penawaran Spesial Hari Ini!' }}
                    </h1>
                    <p style="font-size: 1.1rem; color: #ddd; max-width: 600px;">
                        @if ($biggestDiscount)
                            Nikmati diskon hingga 
                            <strong>{{ $biggestDiscount->discount_value }}{{ $biggestDiscount->discount_type === 'percent' ? '%' : ' Rp' }}</strong> 
                            untuk <strong>{{ $biggestDiscount->product->name }}</strong>.  
                            Sekarang hanya <strong>Rp{{ number_format($biggestDiscount->calculated_final_price) }}</strong>!
                        @else
                            Daftar email sekarang dan dapatkan <strong>10% OFF</strong> untuk semua pembelian!
                        @endif
                    </p>
                </div>

                <div class="col-lg-4 col-md-12 text-lg-end text-md-start">
                    <a href="{{ $biggestDiscount ? route('detail', $biggestDiscount->product->id) : '#' }}"
                        class="btn-promo"
                        style="background-color: #fff; color: #111; padding: 1rem 2.5rem; 
                               font-weight: 700; font-size: 1rem; text-transform: uppercase; 
                               letter-spacing: 1px; text-decoration: none; transition: 0.3s;">
                        {{ $biggestDiscount ? 'Lihat Produk' : 'Daftar Sekarang' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.btn-promo:hover {
    background-color: #e5e5e5;
    color: #000;
}
@media (max-width: 768px) {
    .promo-banner {
        padding: 2.5rem 1.5rem !important;
        text-align: center;
    }
    .btn-promo {
        margin-top: 1.5rem;
        display: inline-block;
    }
}
</style>





    @if (request()->routeIs('home.index'))
        <!--feature start -->
        <section id="feature" class="feature">
            <div class="container">
                <div class="section-header">
                    <h2>featured products</h2>
                </div><!--/.section-header-->

                <div class="feature-content">
                    <div class="row">
                        @foreach ($featuredProduct->take(4) as $product)
                            <div class="col-sm-3">
                                <div class="single-feature">
                                    <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid">
                                    <div class="single-feature-txt text-center">
                                        <p>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span class="spacial-feature-icon"><i class="fa fa-star"></i></span>
                                            <span class="feature-review">(45 review)</span>
                                        </p>
                                        <h3>
                                            <a href="{{ route('detail', $product->id) }}">{{ $product->name }}</a>
                                        </h3>

                                        @if ($product->discount && $product->discount->status === 'active')
                                            <h5>
                                                <del class="text-muted small">
                                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                                </del>
                                                Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                                            </h5>
                                        @else
                                            <h5>Rp{{ number_format($product->price, 0, ',', '.') }}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div><!--/.row-->
                </div><!--/.feature-content-->
            </div><!--/.container-->
        </section><!--/.feature-->
        <!--feature end -->
    @endif





@endsection
