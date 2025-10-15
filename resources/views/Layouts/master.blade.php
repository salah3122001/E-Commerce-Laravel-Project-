<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description">

    <!-- title -->
    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('assets/img/clickandcollect2.png') }}">
    <!-- google font -->
    <link href="{{ asset('fonts/website_fonts1.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/website_fonts2.css') }}" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    @yield('css')
    <style>
        .footer-area a:hover {
            color: #1cc88a !important;
            transition: 0.3s;
        }

        .footer-area h5 {
            color: #fff;
        }

        .footer-area p,
        .footer-area li {
            color: #ccc;
            font-size: 0.95rem;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->


    <!-- header -->
    <div class="top-header-area shadow-sm" id="sticker">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="main-menu-wrap d-flex justify-content-between align-items-center">

                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/">
                                <img src="{{ asset('assets/img/clickandcollect2.png') }}" alt="Logo"
                                    style="max-height: 55px; width: 55px; border-radius: 50%; object-fit: cover;">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu d-none d-lg-block">
                            <ul class="d-flex align-items-center mb-0">

                                <!-- Home -->
                                <li class="mx-2">
                                    <a href="/">{{ __('messages.home') }}</a>
                                </li>

                                <!-- Products -->
                                <li class="nav-item dropdown mx-2">
                                    <a class="nav-link dropdown-toggle" href="{{ route('allproducts') }}"
                                        id="productsDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ __('messages.products') }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                        <li><a class="dropdown-item"
                                                href="{{ route('allproducts') }}">{{ __('messages.products') }}</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('prodtable') }}">{{ __('messages.anotherView') }}</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Category -->
                                <li class="mx-2"><a href="/category">{{ __('messages.category') }}</a></li>

                                <!-- Previous Orders -->
                                <li class="mx-2"><a
                                        href="{{ route('previousorders') }}">{{ __('messages.previous_orders') }}</a>
                                </li>

                                <!-- Clients Reviews -->
                                <li class="mx-2"><a
                                        href="{{ route('getreviews') }}">{{ __('messages.clients_reviews') }}</a></li>

                                <!-- Auth -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="mx-2">
                                            <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="mx-2">
                                            <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown mx-2">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('userProfile', Auth::user()->id) }}">{{ __('messages.profile') }}</a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    {{ __('messages.logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest

                                <!-- Dashboard for Admin -->
                                @if (Auth::check() && Auth::user()->role === 'admin')
                                    <li class="mx-2">
                                        <a href="{{ route('dashboard') }}">{{ __('messages.godash') }}</a>
                                    </li>
                                @endif

                                <!-- Language Switcher -->
                                <li class="nav-item dropdown mx-2">
                                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        🌐 {{ strtoupper(app()->getLocale()) }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                                        <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                                        <li><a class="dropdown-item" href="{{ url('lang/ar') }}">العربية</a></li>
                                    </ul>
                                </li>

                                <!-- Cart + Search -->
                                <li class="mx-2">
                                    <div class="header-icons d-flex align-items-center gap-2">
                                        <a class="shopping-cart" href="{{ route('cart') }}">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                        <a class="search-bar-icon" href="#">
                                            <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </nav>

                        <!-- Mobile menu -->
                        <div class="mobile-menu d-lg-none"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->



    <!-- search area -->


    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <h3>{{ __('messages.searchfor') }}:</h3>
                            <form action="{{ route('search') }}" method="post">
                                @csrf

                                <input type="text" name="searchkey" placeholder="{{ __('messages.writehere') }}">

                                <button type="submit">{{ __('messages.search') }} <i
                                        class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <!-- home page slider -->
    <div class="homepage-slider">

        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1"
            style="background-image: url('{{ asset('assets/img/hero-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('messages.fresh_organic') }}</p>
                                <h1>{{ __('messages.delicious_fruits') }}</h1>
                                <div class="hero-btns">
                                    @if (!auth()->check())
                                        <a href="{{ route('register') }}"
                                            class="boxed-btn">{{ __('messages.register') }}</a>
                                    @endif

                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-center">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('messages.fresh_everyday') }}</p>
                                <h1>{{ __('messages.organic_collection') }}</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('allproducts') }}"
                                        class="boxed-btn">{{ __('messages.visitshop') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('messages.shop_now') }}</p>
                                <h1>{{ __('messages.discover_new_products') }}</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('allproducts') }}"
                                        class="boxed-btn">{{ __('messages.visitshop') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 text-right">
                        <div class="hero-text">
                            <div class="hero-text-tablecell">
                                <p class="subtitle">{{ __('messages.new_arrivals') }}</p>
                                <h1>{{ __('messages.best_sellers') }}</h1>
                                <div class="hero-btns">
                                    <a href="{{ route('allproducts') }}"
                                        class="boxed-btn">{{ __('messages.visitshop') }}</a>
                                    {{-- <a href="contact.html" class="bordered-btn">Contact Us</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end home page slider -->




    @yield('content')

    <!-- Footer -->
    <footer class="footer-area mt-5 text-light" style="background-color:#2c2f33;">
        <div class="container py-5">
            <div class="row gy-4">

                <!-- About -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">{{ __('messages.aboutus') }}</h5>
                    <p class="text-light-50">
                        {{ __('messages.footer_about_text') ?? 'We provide the best fresh and organic products for a healthy life. Shop with confidence and enjoy fast delivery!' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">{{ __('messages.quicklinks') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/"
                                class="text-light text-decoration-none">{{ __('messages.home') }}</a></li>
                        <li class="mb-2">
                            <a class="nav-link dropdown-toggle" href="{{ route('allproducts') }}"
                                id="productsDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ __('messages.products') }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                <li><a class="dropdown-item"
                                        href="{{ route('allproducts') }}">{{ __('messages.products') }}</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('prodtable') }}">{{ __('messages.anotherView') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="mb-2"><a href="/category"
                                class="text-light text-decoration-none">{{ __('messages.category') }}</a></li>
                        <li class="mb-2"><a href="{{ route('getreviews') }}"
                                class="text-light text-decoration-none">{{ __('messages.clients_reviews') }}</a></li>
                        <li><a href="{{ route('previousorders') }}"
                                class="text-light text-decoration-none">{{ __('messages.previous_orders') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">{{ __('messages.contactus') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Mansoura, Egypt</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> mohamed_ashraf4444@hotmail.com</li>
                        <li><i class="fas fa-phone me-2"></i> 01010613746</li>
                    </ul>

                    <div class="social-icons mt-3">
                        <a href="https://www.facebook.com/mohamed.ashraf.898325" class="text-light me-3"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/mohamed_ashraf402/?next=%2F#" class="text-light me-3"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/in/mohamed-ashraf-14916a367" class="text-light me-3"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom text-center py-3" style="background-color:#23272a;">
            <small>
                © {{ date('Y') }} <strong>{{__('messages.c_and_c')}}</strong> —
                {{ __('messages.all_rights_reserved') ?? 'All rights reserved.' }}
            </small>
        </div>
    </footer>



    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>


    <!-- count down -->
    <script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
    <!-- isotope -->
    <script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
    <!-- waypoints -->
    <script src="{{ asset('assets/js/waypoints.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- mean menu -->
    <script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
    <!-- sticker js -->
    <script src="{{ asset('assets/js/sticker.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Bootstrap Bundle with Popper (لازم عشان الـ dropdown يشتغل) --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>




    @stack('scripts')

</body>

</html>
