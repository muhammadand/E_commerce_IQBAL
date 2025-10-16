@extends('layouts.app')
@section('content')
<section class="py-4" style="background-color: #fce4ec;">
    <div class="container">
        <div class="text-center">
            <h2 class="fw-bold text-uppercase" style="color: #d81b60;">Detail Produk</h2>
            <p class="text-muted" style="font-size: 14px;">Temukan informasi lengkap mengenai produk pilihanmu di bawah ini</p>
        </div>
    </div>
</section>



    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
               <!-- Product Section -->
<div class="row g-4 align-items-start justify-content-center mt-4" style="font-family: 'Segoe UI', sans-serif;">

    <!-- Product Image -->
    <div class="col-md-6">
        <div class="p-3 rounded shadow-sm bg-white text-center" style="border: 1px solid #f8bbd0;">
            <img src="/images/{{ $product->image }}" alt="{{ $product->name }}"
                 style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 12px;">
        </div>
    </div>

    <!-- Product Detail -->
    <div class="col-md-6">
        <div class="p-4 rounded" style="background-color: #fff0f5; border: 1px solid #f8bbd0;">

            <!-- Nama -->
            <h2 class="fw-bold mb-2" style="color: #d81b60; font-size: 24px;">
                {{ $product->name }}
            </h2>

            <!-- Rating -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="color: #ffc107;">
                    @php
                        $fullStars = floor($averageRating);
                        $halfStar = round($averageRating - $fullStars, 1) == 0.5;
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            <i class="fa fa-star"></i>
                        @elseif ($halfStar && $i == $fullStars + 1)
                            <i class="fa fa-star-half-o"></i>
                        @else
                            <i class="fa fa-star-o"></i>
                        @endif
                    @endfor
                </div>
                <a href="#tab3" class="text-decoration-none" style="font-size: 13px; color: #666;">
                    {{ $totalReviews }} Review(s)
                </a>
            </div>

            <!-- Harga dan Stok -->
            <div class="mb-3">
                <h4 class="fw-bold" style="color: #d81b60;">
                    @if ($product->discount && $product->discount->status === 'active')
                        <del class="text-muted fs-6">Rp{{ number_format($product->price, 0, ',', '.') }}</del><br>
                        Rp{{ number_format($product->discount->final_price, 0, ',', '.') }}
                    @else
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    @endif
                </h4>
                <small class="text-success">Stok: {{ $product->stock }}</small>
            </div>

            <!-- Deskripsi -->
            <p class="text-secondary" style="line-height: 1.6;">
                {{ $product->description }}
            </p>

            <!-- Form Cart -->
            <form action="{{ route('cart.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <label for="quantity" class="fw-semibold mb-0">Qty:</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                           class="form-control" style="width: 80px; border-color: #f8bbd0;">
                </div>

                <button type="submit" class="btn"
                        style="background-color: #f06292; color: #fff; font-weight: 600; padding: 8px 24px; border-radius: 8px;">
                    <i class="fa fa-shopping-cart me-1"></i> Tambah ke Keranjang
                </button>
            </form>

            <!-- Kategori -->
            <ul class="list-unstyled mt-4 mb-2">
                <li class="text-muted">
                    Kategori:
                    <a href="#" class="text-decoration-none fw-medium" style="color: #d81b60;">
                        {{ $product->category->name }}
                    </a>
                </li>
            </ul>

            <!-- Share -->
            <div class="d-flex align-items-center gap-3 mt-2">
                <span class="text-muted">Bagikan:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('detail', $product->id)) }}"
                   target="_blank" style="color: #3b5998;">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode(route('detail', $product->id)) }}"
                   target="_blank" style="color: #25d366;">
                    <i class="fa fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>

</div>
<!-- /Product Section -->



<!-- Product tab -->
<div class="col-md-12 mt-5">
    <div id="product-tab">
        <!-- Tab Navigation -->
        <ul class="tab-nav d-flex gap-3 mb-4" style="list-style: none; padding: 0; border-bottom: 2px solid #f8bbd0;">
            <li class="active">
                <a href="javascript:void(0);" onclick="showTab('tab1')"
                   class="text-decoration-none px-3 py-2 d-inline-block"
                   style="color: #d81b60; border-bottom: 2px solid #d81b60; font-weight: 600;">
                   Description
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="showTab('tab3')"
                   class="text-decoration-none px-3 py-2 d-inline-block text-muted"
                   style="font-weight: 500;">
                   Reviews ({{ $totalReviews }})
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Description Tab -->
            <div id="tab1" class="tab-pane active" style="display: block;">
                <div class="p-4 bg-white rounded shadow-sm" style="border: 1px solid #f3c2d3;">
                    <p style="line-height: 1.7; color: #444;">{{ $product->description }}</p>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="tab3" class="tab-pane" style="display: none;">
                <div class="row g-4 mt-2">

                    {{-- Rating Summary --}}
                    <div class="col-md-3">
                        <div class="bg-white p-4 rounded shadow-sm border" style="border-color: #f8bbd0;">
                            <div class="text-center mb-3">
                                <h2 style="font-size: 40px; font-weight: bold; color: #ff9f00;">
                                    {{ number_format($averageRating, 1) }}
                                </h2>
                                <div style="color: #ff9f00;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $fullStars)
                                            <i class="fa fa-star"></i>
                                        @elseif ($halfStar && $i == $fullStars + 1)
                                            <i class="fa fa-star-half-o"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                @foreach (range(5, 1) as $i)
                                    @php
                                        $count = $reviews->where('rating', $i)->count();
                                        $percent = $reviews->count() ? ($count / $reviews->count()) * 100 : 0;
                                    @endphp
                                    <li class="d-flex align-items-center mb-2">
                                        <div style="width: 80px; color: #ff9f00;">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <i class="fa {{ $j <= $i ? 'fa-star' : 'fa-star-o' }}"></i>
                                            @endfor
                                        </div>
                                        <div class="flex-grow-1 mx-2 bg-light rounded" style="height: 8px; overflow: hidden;">
                                            <div class="bg-warning" style="width: {{ $percent }}%; height: 100%;"></div>
                                        </div>
                                        <div style="min-width: 24px; text-align: right; font-size: 14px;">{{ $count }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- List of Reviews --}}
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            @foreach ($reviews as $review)
                                <li class="mb-3 p-3 rounded shadow-sm bg-white border" style="border-color: #eee;">
                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <strong style="font-size: 16px;">{{ $review->name }}</strong>
                                            <div style="font-size: 12px; color: #777;">
                                                {{ $review->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                        <div style="color: #ff9f00;">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa {{ $i <= $review->rating ? 'fa-star' : 'fa-star-o' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="mb-0 text-secondary" style="font-size: 14px;">
                                        {{ $review->review }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Submit Review --}}
                    <div class="col-md-3">
                        <form action="{{ route('reviews.store') }}" method="POST"
                              class="bg-white p-4 rounded shadow-sm border" style="border-color: #f3c2d3;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <input type="text" name="name" placeholder="Your Name"
                                   value="{{ Auth::check() ? Auth::user()->name : '' }}" required
                                   class="form-control mb-3">

                            <input type="email" name="email" placeholder="Your Email"
                                   value="{{ Auth::check() ? Auth::user()->email : '' }}" required
                                   class="form-control mb-3">

                            <textarea name="review" placeholder="Your Review" required
                                      class="form-control mb-3" rows="3"></textarea>

                                      <div class="mb-3">
                                        <label for="rating" class="form-label fw-semibold">Your Rating:</label>
                                        <select name="rating" id="rating" class="form-select" required style="border: 1px solid #f8bbd0; border-radius: 6px;">
                                            <option value="" disabled selected>-- Pilih Rating --</option>
                                            <option value="5">★★★★★ - Sangat Bagus</option>
                                            <option value="4">★★★★ - Bagus</option>
                                            <option value="3">★★★ - Cukup</option>
                                            <option value="2">★★ - Kurang</option>
                                            <option value="1">★ - Buruk</option>
                                        </select>
                                    </div>
                                    

                            <button type="submit" class="btn"
                                    style="background-color: #f06292; color: white; font-weight: 600;">
                                Submit
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /Product tab -->


                <script>
                    function showTab(tabId) {
                        // Hide all tabs
                        const tabs = document.querySelectorAll('.tab-pane');
                        tabs.forEach(tab => {
                            tab.style.display = 'none';
                        });

                        // Remove active class from all tab links
                        const links = document.querySelectorAll('.tab-nav li');
                        links.forEach(link => {
                            link.classList.remove('active');
                        });

                        // Show the selected tab and add active class to its link
                        document.getElementById(tabId).style.display = 'block';
                        const activeLink = Array.from(links).find(link => link.querySelector('a').getAttribute('href') === `#${tabId}`);
                        if (activeLink) {
                            activeLink.classList.add('active');
                        }
                    }
                </script>

            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection
