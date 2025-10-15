<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

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
    <div class="top-header-area" style="position: relative; background:black" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- logo -->
                        <div class="site-logo">
                            <a href="/">
                                <img src="{{ asset('assets/img/clickandcollect2.png') }}" alt="Logo"
                                    style="max-height: 55px; width: 55px; border-radius: 50%; object-fit: cover;">
                            </a>
                        </div>
                        <!-- logo -->

                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li class="current-list-item"><a href="/">{{ __('messages.home') }}</a>

                                </li>
                                <li><a href="{{ route('allproducts') }}">{{ __('messages.products') }}</a>

                                </li>
                                <li><a href="/category">{{ __('messages.category') }}</a></li>


                                <li><a href="{{ route('getreviews') }}">{{ __('messages.clients_reviews') }}</a></li>

                                @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a class="nav-link"
                                                href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <a href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('messages.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>

                                    </li>
                                @endguest

                                <ul>

                                    {{-- Language Switcher --}}
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            🌐 {{ strtoupper(app()->getLocale()) }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                                            <li><a class="dropdown-item" href="{{ url('lang/en') }}">English</a></li>
                                            <li><a class="dropdown-item" href="{{ url('lang/ar') }}">العربية</a></li>
                                        </ul>
                                    </li>

                                </ul>

                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="{{ route('cart') }}"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon" href="#"><i
                                                class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
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
                            <h3>Search For:</h3>
                            <form action="{{ route('search') }}" method="post">
                                @csrf

                                <input type="text" name="searchkey" placeholder="Keywords">

                                <button type="submit">Search <i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->

    <div style="height: 150px"></div>




    @yield('content')

    



    <!-- jquery -->
    <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap -->
    {{-- <script src="{{asset('assets/bootstrap/js/bootstrap.min.js"')}}></script> --}}
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

    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
