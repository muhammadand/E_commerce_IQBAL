<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Asha kitchen</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />


    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}">
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">

</head>

<body>
    <div class="wrapper">
       <!-- Sidebar -->
<div class="sidebar" style="background-color: #fce4ec;">
  <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" style="background-color: #fce4ec;">
          <a href="index.html" class="logo">
              <span class="navbar-brand text-dark fw-bold" style="font-size: 18px;">Asha Kitchen Admin</span>
          </a>

          <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right text-dark"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left text-dark"></i>
              </button>
          </div>
          <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt text-dark"></i>
          </button>
      </div>
      <!-- End Logo Header -->
  </div>

  <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item">
                  @if (Auth::user()->role == 'admin')
                      <a href="{{ route('admin.dashboard') }}" class="text-dark">
                          <i class="fas fa-home text-dark"></i>
                          <p class="text-dark">Dashboard</p>
                      </a>
                  @elseif(Auth::user()->role == 'seller')
                      <a href="{{ route('seller.dashboard') }}" class="text-dark">
                          <i class="fas fa-home text-dark"></i>
                          <p class="text-dark">Dashboard</p>
                      </a>
                  @elseif(Auth::user()->role == 'customer')
                      <a href="{{ route('customer.dashboard') }}" class="text-dark">
                          <i class="fas fa-home text-dark"></i>
                          <p class="text-dark">Dashboard</p>
                      </a>
                  @endif
              </li>

              <li class="nav-section">
                  <span class="sidebar-mini-icon">
                      <i class="fa fa-ellipsis-h text-dark"></i>
                  </span>
                  <h4 class="text-section text-dark">Components</h4>
              </li>

              <li class="nav-item">
                  <a data-bs-toggle="collapse" href="#charts" class="text-dark">
                      <i class="far fa-chart-bar text-dark"></i>
                      <p class="text-dark">Category</p>
                      <span class="caret"></span>
                  </a>
                  <div class="collapse" id="charts">
                      <ul class="nav nav-collapse">
                          <li>
                              <a href="{{ route('categories.index') }}" class="text-dark">
                                  <span class="sub-item text-dark">Category</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('products.index') }}" class="text-dark">
                                  <span class="sub-item text-dark">Products</span>
                              </a>
                          </li>
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a href="{{ route('orders.index') }}" class="text-dark">
                      <i class="fas fa-shopping-cart text-dark"></i>
                      <p class="text-dark">Orders</p>
                      <span class="badge badge-success"></span>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('riwayat.index') }}" class="text-dark">
                      <i class="fas fa-credit-card text-dark"></i>
                      <p class="text-dark">Transaction history</p>
                      <span class="badge badge-success"></span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('sales.report') }}" class="text-dark">
                      <i class="fas fa-chart-line text-dark"></i>
                      <p class="text-dark">Laporan</p>
                      <span class="badge badge-success"></span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('admin.users.index') }}" class="text-dark">
                      <i class="fas fa-users text-dark"></i>
                      <p class="text-dark">Users</p>
                      <span class="badge badge-success"></span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('banners.index') }}" class="text-dark">
                      <i class="fas fa-images text-dark"></i>
                      <p class="text-dark">Banners</p>
                      <span class="badge badge-success"></span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('vouchers.index') }}" class="text-dark">
                      <i class="fas fa-ticket-alt text-dark"></i>
                      <p class="text-dark">Voucher</p>
                      
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('chat.index') }}" class="text-dark">
                      <i class="fas fa-comments text-dark"></i>
                      <p class="text-dark">Chat</p>
                     
                  </a>
              </li>

            
          </ul>
      </div>
  </div>
</div>
<!-- End Sidebar -->


        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.html" class="logo">
                            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
    style="background-color: #fce4ec;">
    <div class="container-fluid">
        <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
            <div class="input-group">
                <!-- Optional search input -->
            </div>
        </nav>

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                    aria-expanded="false" aria-haspopup="true">
                    <i class="fa fa-search text-dark"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                    <form class="navbar-left navbar-form nav-search">
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control" />
                        </div>
                    </form>
                </ul>
            </li>

            <li class="nav-item topbar-user dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic text-dark" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <span class="profile-username text-dark">
                        <span class="op-7">Hi,</span>
                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="u-text">
                                    <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                                    <p class="text-dark">{{ auth()->user()->email }}</p>
                                    <a href="{{ route('profil.admin') }}"
                                        class="btn btn-xs btn-secondary btn-sm">
                                        View Profile
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profil.admin') }}">My Profile</a>
                            <a class="dropdown-item" href="{{ url('chat.index') }}">Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </div>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- End Navbar -->

            </div>



            <div class="container">
                <div class="page-inner">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">



                        @yield('content')









                    </div>
                </div>

              
            </div>


            <footer class="footer" style="background-color: #fce4ec; padding: 1rem 0;">
              <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center text-dark">
                  <nav class="pull-left">
                      <ul class="nav">
                          <li class="nav-item">
                              <a class="nav-link text-dark" href="http://www.themekita.com">
                                  Asha Kitchen
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link text-dark" href="#">Help</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link text-dark" href="#">Licenses</a>
                          </li>
                      </ul>
                  </nav>
          
                  <div class="text-dark">
                      © 2024, made with <i class="fa fa-heart text-danger"></i> by
                      <a href="http://www.themekita.com" class="text-dark fw-semibold">Asha Kitchen</a>
                  </div>
          
                  <div class="text-dark">
                      Distributed by
                      <a target="_blank" href="https://themewagon.com/" class="text-dark fw-semibold">Asha Kitchen</a>.
                  </div>
              </div>
          </footer>
          
            <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
            <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

            <!-- jQuery Scrollbar -->
            <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

            <!-- Chart JS -->
            <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

            <!-- jQuery Sparkline -->
            <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

            <!-- Chart Circle -->
            <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

            <!-- Datatables -->
            <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

            <!-- Bootstrap Notify -->
            <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

            <!-- jQuery Vector Maps -->
            <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

            <!-- Sweet Alert -->
            <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

            <!-- Kaiadmin JS -->
            <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

            <!-- Kaiadmin DEMO methods, don't include it in your project! -->
            <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
            <script src="{{ asset('assets/js/demo.js') }}"></script>

            <script>
                $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#177dff",
                    fillColor: "rgba(23, 125, 255, 0.14)",
                });

                $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#f3545d",
                    fillColor: "rgba(243, 84, 93, .14)",
                });

                $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                    type: "line",
                    height: "70",
                    width: "100%",
                    lineWidth: "2",
                    lineColor: "#ffa534",
                    fillColor: "rgba(255, 165, 52, .14)",
                });
            </script>
</body>

</html>
