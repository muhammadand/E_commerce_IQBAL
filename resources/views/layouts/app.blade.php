<!doctype html>
<html lang="en">

<head>
    <!-- Meta Data -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Furniture</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/logo/favicon.png') }}" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootsnav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">



</head>

<body>




    <!--welcome-hero start -->
    <header id="home" class="welcome-hero">

        @if (request()->routeIs('home.index'))
            <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
                <!--/.carousel-indicator -->
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"><span
                            class="small-circle"></span></li>
                    <li data-target="#header-carousel" data-slide-to="1"><span class="small-circle"></span></li>
                    <li data-target="#header-carousel" data-slide-to="2"><span class="small-circle"></span></li>
                </ol>
                <!--/.carousel-indicator -->

                <!--/.carousel-inner -->
                <div class="carousel-inner" role="listbox">
                    <!-- .item -->
                    <div class="item active">
                        <div class="single-slide-item slide1">
                            <div class="container">
                                <div class="welcome-hero-content">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-txt">
                                                    <h4>great design collection</h4>
                                                    <h2>cloth covered accent chair</h2>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor ut labore et dolore magna aliqua.
                                                    </p>
                                                    <div class="packages-price">
                                                     
                                                    </div>
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-img">
                                                    <img src="assets/images/slider/slider1.png" alt="slider image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.item .active-->

                    <div class="item">
                        <div class="single-slide-item slide2">
                            <div class="container">
                                <div class="welcome-hero-content">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-txt">
                                                    <h4>great design collection</h4>
                                                    <h2>mapple wood accent chair</h2>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                        eiusmod tempor.
                                                    </p>
                                                    <div class="packages-price">
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-img">
                                                    <img src="assets/images/slider/slider2.png" alt="slider image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.item -->

                    <div class="item">
                        <div class="single-slide-item slide3">
                            <div class="container">
                                <div class="welcome-hero-content">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-txt">
                                                    <h4>great design collection</h4>
                                                    <h2>valvet accent arm chair</h2>
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                    </p>
                                                    <div class="packages-price">
                                                   
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="single-welcome-hero">
                                                <div class="welcome-hero-img">
                                                    <img src="assets/images/slider/slider3.png" alt="slider image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.item -->
                </div><!-- /.carousel-inner-->
            </div><!--/#header-carousel-->
        @endif




        <section id="populer-products" class="populer-products">
            <div class="container">
                <div class="populer-products-content">
                    <div class="row">
                        <!-- Produk kiri -->
                        <div class="col-md-3">
                            <div class="single-populer-products">
                                <div class="single-populer-product-img mt40">
                                    <img src="{{ asset('assets/images/populer-products/p1.png') }}"
                                        alt="populer-products image">
                                </div>
                                <h2><a href="#">arm chair</a></h2>
                                <div class="single-populer-products-para">
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit asperna aut odit aut fugit.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Produk tengah -->
                        <div class="col-md-6">
                            <div class="single-populer-products">
                                <div class="single-inner-populer-products">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="single-inner-populer-product-img">
                                                <img src="{{ asset('assets/images/populer-products/p2.png') }}"
                                                    alt="populer-products image">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-12">
                                            <div class="single-inner-populer-product-txt">
                                                <h2>
                                                    <a href="#">
                                                        latest designed stool <span>and</span> chair
                                                    </a>
                                                </h2>
                                                <p>
                                                    Edi ut perspiciatis unde omnis iste natusina error sit voluptatem
                                                    accusantium doloremque laudantium, totam rem aperiam.
                                                </p>
                                                <div class="populer-products-price">
                                                    <h4>Sales Start from <span>$99.00</span></h4>
                                                </div>
                                                <button class="btn-cart welcome-add-cart populer-products-btn"
                                                    onclick="window.location.href='#'">
                                                    discover more
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Produk kanan -->
                        <div class="col-md-3">
                            <div class="single-populer-products">
                                <div class="single-populer-product-img">
                                    <img src="{{ asset('assets/images/populer-products/p3.png') }}"
                                        alt="populer-products image">
                                </div>
                                <h2><a href="#">hanging lamp</a></h2>
                                <div class="single-populer-products-para">
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit asperna aut odit aut fugit.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.container-->
        </section><!--/.populer-products-->
        <!--populer-products end-->


        <!-- top-area Start -->
        <div class="top-area">
            <div class="header-area">
                <!-- Start Navigation -->
                <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"
                    data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

                    <!-- Start Top Search -->
                    <div class="top-search">
                        <div class="container">
                            <form id="search-form" action="{{ route('home.index') }}" method="get"
                                class="input-group">
                                <span class="input-group-addon">
                                    <button type="submit" class="border-0 bg-transparent">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>

                                <input type="text" name="search_query" class="form-control"
                                    placeholder="Cari produk..." value="{{ request('search_query') }}">

                                <span class="input-group-addon close-search">
                                    <i class="fa fa-times"></i>
                                </span>
                            </form>
                        </div>
                    </div>
                    <!-- End Top Search -->


                    <div class="container">
                        <!-- Start Atribute Navigation -->
                        <div class="attr-nav">
                            <ul>
                                <li class="search">
                                    <a href="#"><span class="lnr lnr-magnifier"></span></a>
                                </li><!--/.search-->

                                <!-- Tambahkan icon love di sini -->
                                <li class="wishlist">
                                    <a href="{{ route('wishlist.index') }}">
                                        <span class="lnr lnr-heart"></span>
                                    </a>
                                </li><!--/.wishlist-->

                                <li class="nav-user">
                                    @if (Auth::check())
                                        <!-- Jika user sudah login -->
                                        <a href="{{route('profil')}}" data-bs-toggle="modal" data-bs-target="#modalProfile"
                                            class="border-0">
                                            <span class="lnr lnr-user"></span>
                                        </a>
                                    @else
                                        <!-- Jika user belum login -->
                                        <a href="/login" data-bs-toggle="modal" data-bs-target="#modallogin"
                                            class="border-0">
                                            <span class="lnr lnr-user"></span>
                                        </a>
                                    @endif
                                </li>

                                <li class="dropdown">
                                    <a href="{{ route('cart.index') }}" class="dropdown-toggle"
                                        data-toggle="dropdown">
                                        <span class="lnr lnr-cart"></span>
                                        <span class="badge badge-bg-1">{{ $cartItemsCount }}</span>
                                    </a>
                                </li><!--/.dropdown-->

                            </ul>
                        </div><!--/.attr-nav-->
                        <!-- End Atribute Navigation -->

                        <!-- Start Header Navigation -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="index.html">furn.</a>

                        </div><!--/.navbar-header-->
                        <!-- End Header Navigation -->

                        <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
                            <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                                <li class="{{ request()->routeIs('home.index') ? 'active' : '' }}">
                                    <a href="{{ route('home.index') }}">Home</a>
                                </li>



                                <li class="{{ request()->routeIs('home.order') ? 'active' : '' }}">
                                    <a href="{{ route('home.order') }}">Pesanan Saya</a>
                                </li>

                                <!-- Dropdown Kategori -->
                                <li
                                    class="nav-item dropdown {{ request()->routeIs('home.category') ? 'active' : '' }}">
                                    <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Kategori
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ route('home.category', $category->id) }}"
                                                    class="dropdown-item {{ request()->routeIs('home.category') && request()->route('id') == $category->id ? 'active' : '' }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div><!--/.container-->
                </nav><!--/nav-->
                <!-- End Navigation -->
            </div><!--/.header-area-->
            <div class="clearfix"></div>

        </div><!-- /.top-area-->
        <!-- top-area End -->

    </header><!--/.welcome-hero-->
    <!--welcome-hero end -->



























   

 












   
   














    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>


    @if (Auth::check() && Auth::user()->role === 'customer')
        @include('components.chat-bubble')
    @endif



    <!--newsletter strat -->
    <section id="newsletter" class="newsletter">
        <div class="container">
            <div class="hm-footer-details">
                <div class="row">
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>information</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">about us</a></li><!--/li-->
                                    <li><a href="#">contact us</a></li><!--/li-->
                                    <li><a href="#">news</a></li><!--/li-->
                                    <li><a href="#">store</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>collections</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">wooden chair</a></li><!--/li-->
                                    <li><a href="#">royal cloth sofa</a></li><!--/li-->
                                    <li><a href="#">accent chair</a></li><!--/li-->
                                    <li><a href="#">bed</a></li><!--/li-->
                                    <li><a href="#">hanging lamp</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6 col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>my accounts</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-menu">
                                <ul>
                                    <li><a href="#">my account</a></li><!--/li-->
                                    <li><a href="#">wishlist</a></li><!--/li-->
                                    <li><a href="#">Community</a></li><!--/li-->
                                    <li><a href="#">order history</a></li><!--/li-->
                                    <li><a href="#">my cart</a></li><!--/li-->
                                </ul><!--/ul-->
                            </div><!--/.hm-foot-menu-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                    <div class=" col-md-3 col-sm-6  col-xs-12">
                        <div class="hm-footer-widget">
                            <div class="hm-foot-title">
                                <h4>newsletter</h4>
                            </div><!--/.hm-foot-title-->
                            <div class="hm-foot-para">
                                <p>
                                    Subscribe to get latest news,update and information.
                                </p>
                            </div><!--/.hm-foot-para-->
                            <div class="hm-foot-email">
                                <div class="foot-email-box">
                                    <input type="text" class="form-control" placeholder="Enter Email Here....">
                                </div><!--/.foot-email-box-->
                                <div class="foot-email-subscribe">
                                    <span><i class="fa fa-location-arrow"></i></span>
                                </div><!--/.foot-email-icon-->
                            </div><!--/.hm-foot-email-->
                        </div><!--/.hm-footer-widget-->
                    </div><!--/.col-->
                </div><!--/.row-->
            </div><!--/.hm-footer-details-->

        </div><!--/.container-->

    </section><!--/newsletter-->
    <!--newsletter end -->
    <!--footer start-->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="hm-footer-copyright text-center">
                <div class="footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
                <p>
                    &copy;copyright. designed and developed by <a href="https://www.themesine.com/">themesine</a>
                </p><!--/p-->
            </div><!--/.text-center-->
        </div><!--/.container-->

        <div id="scroll-Top">
            <div class="return-to-top">
                <i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top"
                    title="" data-original-title="Back to Top" aria-hidden="true"></i>
            </div>

        </div><!--/.scroll-Top-->

    </footer><!--/.footer-->
    <!--footer end-->
    <!-- Include all JS compiled plugins (below), or include individual files as needed -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <!-- modernizr.min.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <!-- bootstrap.min.js -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- bootsnav js -->
    <script src="{{ asset('assets/js/bootsnav.js') }}"></script>

    <!-- owl.carousel.js -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>

    <!-- jQuery Easing -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>


</body>

</html>
