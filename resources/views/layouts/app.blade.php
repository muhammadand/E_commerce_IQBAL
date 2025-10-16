<!DOCTYPE html>
<html lang="en">

<head>
    <title>Asha Kitchen</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="TemplatesJungle">
    <meta name="keywords" content="Online Store">
    <meta name="description" content="Stylish - Shoes Online Store HTML Template">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (bundle includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Load CSS from public folder --}}
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,900;1,900&family=Source+Sans+Pro:wght@400;600;700;900&display=swap"
        rel="stylesheet">
        <style>
          /* Warna latar obrolan */
          #bubble-messages {
              background-color: #fff0f5; /* lavender blush */
              color: #4a4a4a;
          }
      
          .chat-box {
              background-color: #ffffff;
              border: 1px solid #f8bbd0;
              box-shadow: 0 4px 12px rgba(248, 187, 208, 0.3); /* pink lembut */
          }
      
          .chat-input-area {
              background-color: #fff0f5;
              border-top: 1px solid #f8bbd0;
          }
      
          .chat-header {
              background-color: #fce4ec;
              color: #4a4a4a;
          }
      
          /* Navbar */
          .navbar {
              background-color: #fce4ec !important;
          }
      
          .navbar .nav-link {
              color: #4a4a4a !important;
          }
      
          .navbar .nav-link.active,
          .navbar .nav-link:hover {
              color: #f06292 !important; /* pink medium */
          }
      
          .navbar-brand span {
              color: #f06292 !important;
          }
      
          /* Dropdown menu */
          .dropdown-menu {
              background-color: #fff0f5;
              color: #4a4a4a;
          }
      
          .dropdown-menu .dropdown-item {
              color: #4a4a4a;
          }
      
          .dropdown-menu .dropdown-item:hover {
              background-color: #f8bbd0;
              color: #4a4a4a;
          }
      
          /* Ikon user & lainnya */
          .user-items i {
              color: #f06292 !important;
          }
      
          /* Pencarian */
          .search-box {
              background-color: #fce4ec;
          }
      
          input.search-input {
              background-color: #fff0f5;
              border: 1px solid #f8bbd0;
              color: #4a4a4a;
          }
      
          input.search-input::placeholder {
              color: #b77a91;
          }
      </style>
      

</head>

<body>

  

    <div class="search-box bg-dark position-relative">
        <div class="search-wrap">
            <div class="close-button">
                <svg class="close" style="fill: white;">
                    <use xlink:href="#close"></use>
                </svg>
            </div>
            <form id="search-form" class="text-lg-center text-md-left pt-3" action="{{ route('home.index') }}"
                method="get">
                <input type="text" class="search-input" name="search_query" placeholder="Search..."
                    value="{{ request('search_query') }}">
                <svg class="search">
                    <use xlink:href="#search"></use>
                </svg>
            </form>
        </div>
    </div>


    <header id="header" class="site-header text-black" style="background-color: #fce4ec;">
      <div class="header-top border-bottom py-2">
        <div class="container-lg">
          <div class="row align-items-center justify-content-between">
    
            <!-- Social Media -->
            <div class="col-md-4 d-flex justify-content-start">
              <ul class="social-links list-unstyled d-flex m-0 gap-3">
                <li>
                  <a href="#" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a href="#" class="text-dark"><i class="fab fa-instagram"></i></a>
                </li>
                <li>
                  <a href="#" class="text-dark"><i class="fab fa-youtube"></i></a>
                </li>
                <li>
                  <a href="#" class="text-dark"><i class="fab fa-pinterest-p"></i></a>
                </li>
              </ul>
            </div>
    
            <!-- Promo -->
            <div class="col-md-4 text-center">
              @if ($biggestDiscount && $biggestDiscount->calculated_final_price < 100)
                <p class="text-danger fw-bold m-0" style="font-size: 15px;">
                  🎉 <strong>Special Offer:</strong> Buruan cek diskonnya!
                </p>
              @elseif ($biggestDiscount)
                <p class="text-danger fw-bold m-0" style="font-size: 15px;">
                  🎁 <strong>Special Offer:</strong> {{ $biggestDiscount->product->name }} hanya
                  <span style="color: #d81b60;">Rp{{ number_format($biggestDiscount->calculated_final_price) }}</span>
                </p>
              @else
                <p class="text-muted fw-bold m-0" style="font-size: 15px;">
                  💬 <strong>Special Offer:</strong> Cek promo terbaru di toko kami!
                </p>
              @endif
            </div>
    
            <!-- User Points -->
            <div class="col-md-4 d-flex justify-content-end">
              @auth
                <span class="badge text-dark" style="background-color: #f8bbd0; font-size: 14px;">
                  👤 Poin Anda: <strong>{{ number_format(Auth::user()->points, 0, ',', '.') }}</strong>
                </span>
              @endauth
            </div>
    
          </div>
        </div>
      </div>
    </header>
    
            <nav id="header-nav" class="navbar navbar-expand-lg">
              <div class="container-lg">
                  <a class="navbar-brand" href="index.html">
                      <span style="font-size: 24px; font-weight: bold; color: #333;">Asha Kitchen</span>
                  </a>
          
                  <button class="navbar-toggler d-flex d-lg-none order-3 border-0 p-1 ms-2" type="button"
                      data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fas fa-bars fa-lg"></i>
                  </button>
          
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar">
                      <div class="offcanvas-header px-4 pb-0">
                          <a class="navbar-brand ps-3" href="index.html">
                              <img src="images/main-logo.png" class="logo" alt="logo">
                          </a>
                          <button type="button" class="btn-close btn-close-black p-5" data-bs-dismiss="offcanvas"
                              aria-label="Close" data-bs-target="#bdNavbar"></button>
                      </div>
                      <div class="offcanvas-body">
                          <ul id="navbar" class="navbar-nav fw-bold justify-content-end align-items-center flex-grow-1">
                              <li class="nav-item">
                                  <a class="nav-link me-5" href="{{ route('home.index') }}">Home</a>
                              </li>
          
                              <li class="nav-item dropdown">
                                  <a class="nav-link me-5 active dropdown-toggle border-0" href="#"
                                      data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                                  <ul class="dropdown-menu fw-bold">
                                      @foreach ($categories as $category)
                                          <li class="{{ request()->routeIs('home.category') && request()->route('id') == $category->id ? 'active' : '' }}">
                                              <a href="{{ route('home.category', $category->id) }}" class="dropdown-item fw-light">{{ $category->name }}</a>
                                          </li>
                                      @endforeach
                                  </ul>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link me-5" href="{{ route('user.store') }}">Shop</a>
                              </li>
          
                              <li class="nav-item">
                                  <a class="nav-link me-5" href="{{ route('home.order') }}">Your Order</a>
                              </li>
                          </ul>
                      </div>
                  </div>
          
                  <div class="user-items ps-0 ps-md-5">
                      <ul class="d-flex justify-content-end list-unstyled align-item-center m-0">
                          <li class="pe-3">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#wishlistModal" class="border-0">
                                  <i class="far fa-heart fa-lg" style="color: black;"></i>
                              </a>
                          </li>
          
                          <li class="pe-3">
                              @if (Auth::check())
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalProfile" class="border-0">
                                      <i class="fas fa-user fa-lg" style="color: black;"></i>
                                  </a>
                              @else
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#modallogin" class="border-0">
                                      <i class="fas fa-user fa-lg" style="color: black;"></i>
                                  </a>
                              @endif
                          </li>
          
                          <li class="pe-3">
                              <a href="#" data-bs-toggle="modal" data-bs-target="#modallong" class="border-0">
                                  <i class="fas fa-shopping-cart fa-lg" style="color: black;"></i>
                              </a>
                          </li>
          
                          <li>
                              <a href="#" class="search-item border-0" data-bs-toggle="collapse"
                                  data-bs-target="#search-box" aria-label="Toggle navigation">
                                  <i class="fas fa-search fa-lg" style="color: black;"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
          
        </header>




        <div class="modal fade" id="modallong" tabindex="-1" aria-modal="true" role="dialog">
          <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius: 1rem; background-color: #fff0f5; border: 1px solid #f8bbd0;">
              <div class="modal-header" style="background-color: #fce4ec; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h2 class="modal-title fs-5" style="color: #4a4a4a;">Cart</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="shopping-cart">
                  <div class="shopping-cart-content" style="border-radius: 1rem; background-color: #ffffff; padding: 1rem;">
                    <div class="mini-cart cart-list p-0 mt-3">
                      <form action="{{ route('checkout.selected') }}" method="POST">
                        @csrf
                        @foreach ($cartItems as $item)
                          @php
                              $product = $item->product;
                              $price = $product?->price ?? 0;
                              $name = $product?->name ?? 'Produk tidak ditemukan';
                              $image = $product?->image ?? 'images/default.jpg';
                              $subtotal = $item->quantity * $price;
                          @endphp
                      
                          <div class="mini-cart-item d-flex border-bottom pb-3 align-items-center"
                               style="background-color: #fce4ec; border-radius: 1rem; padding: 1rem; margin-bottom: 1rem;">
                               
                            <div class="me-3 d-flex align-items-center justify-content-center" style="min-width: 40px;">
                              <input class="form-check-input item-checkbox"
                                     type="checkbox"
                                     name="selected_items[]"
                                     value="{{ $item->id }}"
                                     data-subtotal="{{ $subtotal }}"
                                     style="width: 20px; height: 20px; border: 2px solid #f8bbd0; border-radius: 4px; cursor: pointer; accent-color: #f06292;">
                            </div>
                      
                            <div class="d-flex align-items-start gap-3" style="flex: 1;">
                              <div style="width: 70px;">
                                <img src="/images/{{ $image }}" class="img-fluid" alt="{{ $name }}"
                                     style="border-radius: 0.75rem; object-fit: cover; width: 100%; height: 70px;">
                              </div>
                              <div class="flex-grow-1">
                                <div class="d-flex justify-content-between mb-2">
                                  <span class="fs-6 fw-semibold" style="color: #4a4a4a;">{{ Str::limit($name, 40) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                  <input type="number" name="quantity[{{ $item->id }}]"
                                         class="form-control form-control-sm quantity"
                                         value="{{ $item->quantity }}" disabled
                                         style="max-width: 70px; border-radius: 6px; border: 1px solid #f8bbd0; background-color: #fff0f5; color: #4a4a4a; font-size: 13px;">
                                  <span class="fw-bold" style="color: #d81b60; font-size: 14px;">
                                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      
                        <!-- Subtotal -->
                        <div class="mini-cart-total d-flex justify-content-between py-4"
                             style="border-top: 1px solid #f8bbd0; color: #4a4a4a;">
                          <span class="fs-6">Subtotal:</span>
                          <span class="special-price-code">
                            <span class="price-amount amount fs-6" id="subtotal-display">
                              <bdi><span class="price-currency-symbol">Rp</span>0</bdi>
                            </span>
                          </span>
                        </div>
                      
                        <!-- Footer Buttons -->
                        <div class="modal-footer my-4 justify-content-center">
                          <a href="{{ route('cart.index') }}"
                             style="background-color: #f06292; border-radius: 0.75rem; color: white; padding: 0.5rem 1.25rem; font-weight: 600; text-decoration: none;">
                            View Cart
                          </a>
                          <button type="submit"
                                  style="border: 2px solid #f06292; border-radius: 0.75rem; color: #f06292; padding: 0.5rem 1.25rem; font-weight: 600; background-color: transparent;">
                            Checkout Selected
                          </button>
                        </div>
                      </form>
                      
                    </div> <!-- end mini-cart -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Subtotal Script -->
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            const subtotalDisplay = document.getElementById('subtotal-display');
        
            function updateSubtotal() {
              let subtotal = 0;
        
              checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                  const itemSubtotal = parseFloat(checkbox.getAttribute('data-subtotal'));
                  subtotal += itemSubtotal;
                }
              });
        
              subtotalDisplay.innerHTML = '<bdi><span class="price-currency-symbol">Rp</span>' + subtotal.toLocaleString('id-ID') + '</bdi>';
            }
        
            checkboxes.forEach(function (checkbox) {
              checkbox.addEventListener('change', updateSubtotal);
            });
        
            // Hitung ulang ketika modal dibuka
            const modal = document.getElementById('modallong');
            modal.addEventListener('shown.bs.modal', updateSubtotal);
          });
        </script>
        






      <div class="card card-round">

        {{-- Success Modal --}}
        @if (session('success'))
          <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="z-index: 1055;">
              <div class="modal-content" style="background: #f0fff4; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="modal-header border-0">
                  <h5 class="modal-title d-flex align-items-center" id="successModalLabel" style="color: #256029;">
                    <i class="fas fa-check-circle me-2 text-success"></i> Sukses
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-dark" style="font-size: 15px;">
                  {{ session('success') }}
                </div>
                <div class="modal-footer border-0">
                  <button type="button" class="btn btn-outline-success btn-sm px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                  </button>
                </div>
              </div>
            </div>
          </div>
      
          <script>
            window.addEventListener('load', function () {
              const successModal = new bootstrap.Modal(document.getElementById('successModal'), { keyboard: false });
              successModal.show();
            });
          </script>
        @endif
      
        {{-- Error Modal --}}
        @if (session('error'))
          <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="z-index: 1055;">
              <div class="modal-content" style="background: #fff5f5; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
                <div class="modal-header border-0">
                  <h5 class="modal-title d-flex align-items-center" id="errorModalLabel" style="color: #b71c1c;">
                    <i class="fas fa-times-circle me-2 text-danger"></i> Gagal
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-dark" style="font-size: 15px;">
                  {{ session('error') }}
                </div>
                <div class="modal-footer border-0">
                  <button type="button" class="btn btn-outline-danger btn-sm px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                  </button>
                </div>
              </div>
            </div>
          </div>
      
          <script>
            window.addEventListener('load', function () {
              const errorModal = new bootstrap.Modal(document.getElementById('errorModal'), { keyboard: false });
              errorModal.show();
            });
          </script>
        @endif
      
      </div>
      


  <div class="modal fade" id="wishlistModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius: 1rem; background-color: #fff0f5; border: 1px solid #f8bbd0;">
            <div class="modal-header" style="background-color: #fce4ec; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h2 class="modal-title fs-5" style="color: #4a4a4a;">Wishlist</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="shopping-cart">
                    <div class="shopping-cart-content" style="border-radius: 1rem; background-color: #ffffff; padding: 1rem;">
                        <div class="mini-cart cart-list p-0 mt-3">
                            @php $total = 0; @endphp
                            @forelse ($wishlistItems as $item)
                                @php
                                    $product = $item->product;
                                    $price = $product?->price ?? 0;
                                    $name = $product?->name ?? 'Produk tidak ditemukan';
                                    $image = $product?->image ?? 'images/default.jpg';
                                    $subtotal = $price;
                                    $total += $subtotal;
                                @endphp

                                <div class="mini-cart-item d-flex border-bottom pb-3 align-items-start"
                                     style="background-color: #fce4ec; border-radius: 1rem; padding: 1rem; margin-bottom: 1rem;">
                                    <div class="col-lg-2 col-md-3 col-sm-2 me-4">
                                        <a href="{{ route('detail', $product->id) }}" title="product-image">
                                            <img src="/images/{{ $product->image }}" class="img-fluid" alt="{{ $name }}"
                                                 style="border-radius: 0.75rem;">
                                        </a>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-8">
                                        <div class="product-header d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="product-title fs-6 me-5" style="color: #4a4a4a;">{{ $name }}</h4>
                                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST"
                                                  onsubmit="return confirm('Hapus dari wishlist?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm"
                                                    style="border: 1px solid #f06292; color: #f06292; border-radius: 0.5rem;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                        <div class="price-code">
                                            <span class="product-price fs-6"
                                                  style="color: #d81b60; font-weight: bold;">
                                                Rp{{ number_format($price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center" style="color: #888;">Wishlist Anda kosong.</p>
                            @endforelse

                            @if (count($wishlistItems))
                                <div class="mini-cart-total d-flex justify-content-between py-4"
                                     style="border-top: 1px solid #f8bbd0; color: #4a4a4a;">
                                    <span class="fs-6">Total Wishlist:</span>
                                    <span class="special-price-code">
                                        <span class="price-amount amount fs-6" style="opacity: 1;">
                                            <bdi><span class="price-currency-symbol">Rp</span>{{ number_format($total, 0, ',', '.') }}</bdi>
                                        </span>
                                    </span>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modallogin" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered" role="document">
    <div class="modal-content p-4" style="background-color: #fce4ec; border-radius: 1rem;">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="modal-header mx-auto border-0">
        <h2 class="modal-title fs-3 fw-normal" style="color: #4a4a4a;">Login</h2>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('login.action') }}">
          @csrf
          <input type="email" name="email" placeholder="Email Address *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <input type="password" name="password" placeholder="Password *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
            <label style="font-size: 14px;">
              <input type="checkbox" name="rememberme"> Remember me
            </label>
            <a href="#" style="font-size: 14px; color: #c2185b;">Forgot password?</a>
          </div>

          <div class="modal-footer mt-4 d-flex justify-content-center border-0">
            <button type="submit" class="btn"
              style="background-color: #f06292; color: white; border-radius: 8px; padding: 8px 20px; border: none;">
              Login
            </button>
            <button type="button" class="btn"
              style="border: 1px solid #f06292; color: #f06292; border-radius: 8px; padding: 8px 20px; margin-left: 10px;"
              data-bs-toggle="modal" data-bs-target="#modalregister" data-bs-dismiss="modal">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalregister" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-fullscreen-md-down modal-md modal-dialog-centered" role="document">
    <div class="modal-content p-4" style="background-color: #fce4ec; border-radius: 1rem;">
      <div class="modal-header mx-auto border-0">
        <h2 class="modal-title fs-3 fw-normal" style="color: #4a4a4a;">Register</h2>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('register.action') }}">
          @csrf
          <input type="hidden" name="role" value="customer">

          <input type="text" name="name" placeholder="Full Name *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <input type="email" name="email" placeholder="Email Address *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <input type="password" name="password" placeholder="Password *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <input type="password" name="password_confirmation" placeholder="Confirm Password *" required
            style="width: 100%; padding: 10px 15px; margin-bottom: 15px; border: 1px solid #f8bbd0; border-radius: 10px; font-size: 14px;">

          <div class="modal-footer mt-4 d-flex justify-content-center border-0">
            <button type="submit" class="btn"
              style="background-color: #f06292; color: white; border-radius: 8px; padding: 8px 20px; border: none;">
              Register
            </button>
            <button type="button" class="btn"
              style="border: 1px solid #f06292; color: #f06292; border-radius: 8px; padding: 8px 20px; margin-left: 10px;"
              data-bs-toggle="modal" data-bs-target="#modallogin" data-bs-dismiss="modal">
              Back to Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


      @auth
      <div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-color: #fce4ec; border-radius: 1rem; border: none; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
            
            <!-- Header -->
            <div class="modal-header border-0 justify-content-center position-relative">
              <div style="position: absolute; top: -50px;">
                <img src="https://i.pravatar.cc/100?u={{ Auth::user()->email }}" alt="Avatar" style="width: 100px; height: 100px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
              </div>
            </div>
      
            <!-- Body -->
            <div class="modal-body pt-5 px-4 text-center">
              <h4 class="mb-3" style="color: #880e4f;">Halo, {{ Auth::user()->name }}!</h4>
      
              <div style="text-align: left;">
                <p style="margin-bottom: 10px;"><i class="fas fa-envelope me-2"></i><strong>Email:</strong><br> {{ Auth::user()->email }}</p>
                <p style="margin-bottom: 10px;"><i class="fas fa-map-marker-alt me-2"></i><strong>Alamat:</strong><br> {{ Auth::user()->alamat }}</p>
                <p style="margin-bottom: 10px;"><i class="fas fa-phone-alt me-2"></i><strong>Nomor Telepon:</strong><br> {{ Auth::user()->nomor_telpon }}</p>
                <p style="margin-bottom: 0;"><i class="fas fa-star me-2"></i><strong>Points:</strong> {{ Auth::user()->points }}</p>
              </div>
            </div>
      
            <!-- Footer -->
            <div class="modal-footer border-0 justify-content-between px-4 pb-4">
              <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
              <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn" style="background-color: #e91e63; color: white; border-radius: 8px; padding: 8px 16px; border: none;">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
              </button>
              <a href="{{ route('profil.edit') }}" class="btn" style="border: 1px solid #e91e63; color: #e91e63; border-radius: 8px; padding: 8px 16px;">
                <i class="fas fa-user-edit me-1"></i> Edit Profil
              </a>
            </div>
          </div>
        </div>
      </div>
      
      @endauth





  





        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
   
        <script type="module">
          import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js"
          Chatbot.init({
              chatflowid: "ccf65a95-a647-4577-8c59-199abf9fe8b7",
              apiHost: "https://cloud.flowiseai.com",
          })
      </script>
      
        {{-- @if (Auth::check() && Auth::user()->role === 'customer')
            @include('components.chat-bubble')
        @endif --}}
        <footer id="footer" class="py-5 border-top" style="background-color: #fce4ec; color: #212121;">
          <div class="container-lg">
              <div class="row gy-4">
      
                  <!-- Tentang Asha Kitchen -->
                  <div class="col-lg-3 col-sm-6">
                      <div class="footer-menu">
                          <h5 class="widget-title pb-2 fw-semibold">Tentang Asha Kitchen</h5>
                          <p style="font-size: 15px;">
                              Asha Kitchen adalah toko rumahan yang menjual aneka kue dan bolu dengan cita rasa khas dan bahan berkualitas. Kami menghadirkan kelembutan dalam setiap gigitan.
                          </p>
                      </div>
                  </div>
      
                  <!-- Produk Populer -->
                  <div class="col-lg-3 col-sm-6">
                      <div class="footer-menu">
                          <h5 class="widget-title pb-2 fw-semibold">Produk Populer</h5>
                          <ul class="menu-list list-unstyled">
                              <li class="pb-2">🍰 Bolu Coklat Lembut</li>
                              <li class="pb-2">🧁 Cupcake Vanilla</li>
                              <li class="pb-2">🍮 Pudding Caramel</li>
                              <li class="pb-2">🎂 Birthday Cake Custom</li>
                          </ul>
                      </div>
                  </div>
      
                  <!-- Info & Bantuan -->
                  <div class="col-lg-3 col-sm-6">
                      <div class="footer-menu">
                          <h5 class="widget-title pb-2 fw-semibold">Info & Bantuan</h5>
                          <ul class="menu-list list-unstyled">
                              <li class="pb-2"><a href="{{ route('home.order') }}" class="text-dark text-decoration-none">📦 Cek Pesanan</a></li>
                              <li class="pb-2"><a href="{{ route('ongkir.index') }}" class="text-dark text-decoration-none">🚚 Info Pengiriman</a></li>
                              <li class="pb-2"><a href="#" class="text-dark text-decoration-none">📌 Lokasi Toko</a></li>
                              <li class="pb-2"><a href="#" class="text-dark text-decoration-none">💬 Kontak Admin</a></li>
                          </ul>
                      </div>
                  </div>
      
                  <!-- Hubungi Kami -->
                  <div class="col-lg-3 col-sm-6">
                      <div class="footer-menu">
                          <h5 class="widget-title pb-2 fw-semibold">Hubungi Kami</h5>
                          <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Jalan Mawar No. 12, Kuningan, Jawa Barat</p>
                          <p class="mb-1"><i class="fas fa-phone me-2"></i>0895-1234-56789</p>
                          <p class="mb-0"><i class="fas fa-envelope me-2"></i>
                              <a href="mailto:ashakitchen@gmail.com" class="text-dark text-decoration-none fw-bold">ashakitchen@gmail.com</a>
                          </p>
                      </div>
                  </div>
      
              </div>
      
              <!-- Copyright -->
              <div class="row mt-4 pt-4 border-top">
                  <div class="col-md-6 text-center text-md-start">
                      <p class="mb-0">© 2025 Asha Kitchen. All rights reserved.</p>
                  </div>
                  <div class="col-md-6 text-center text-md-end">
                      <p class="mb-0">
                          Made with ❤️ by <a href="#" class="text-dark text-decoration-underline">Asha Team</a>
                      </p>
                  </div>
              </div>
          </div>
      </footer>
      

        {{-- Load JS --}}
        <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
        <script src="{{ asset('js/plugins.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
