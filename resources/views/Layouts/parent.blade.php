<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('assets/img/clickandcollect.jpg') }}">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="{{ asset('fonts/dashboard_fonts.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- AdminLTE (Bootstrap 4 Based) -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')

    <style>
        body {
            font-family: "Inter", sans-serif;
        }

        html,
        body {
            overflow-x: clip !important;
        }

        .main-header {
            background: #fff;
            border-bottom: 1px solid #eee;
        }

        .brand-link {
            background: #0d6efd;
            color: #fff !important;
        }

        .brand-link .brand-text {
            font-weight: 600;
        }

        .nav-sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        footer.main-footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background: #f8f9fa;
            font-size: 14px;
            color: #555;
        }

        footer.main-footer a {
            color: #0d6efd;
        }

        html[dir="rtl"] body {
            direction: rtl;
            text-align: right;
        }

        html[dir="rtl"] .main-sidebar {
            right: 0;
            left: auto;
        }

        html[dir="rtl"] .content-wrapper {
            margin-right: 250px;
            margin-left: 0;
        }

        html[dir="rtl"] .main-header {
            margin-right: 250px;
            margin-left: 0;
        }

        html[dir="rtl"] .nav-sidebar .nav-link i.right {
            transform: rotate(180deg);
        }

        html[dir="rtl"] .navbar-nav.ml-auto {
            margin-left: 0 !important;
            margin-right: auto !important;
        }

        [dir="rtl"] .nav-sidebar .nav-link {
            white-space: normal !important;
            overflow: visible !important;
        }

        [dir="rtl"] .nav-sidebar {
            overflow-x: visible !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">{{ __('messages.home') }}</a>
                </li>
            </ul>

            <!-- Search -->
            <form class="form-inline ml-3" action="{{ route('adminsearch') }}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" name="searchkey" type="search"
                        placeholder="{{ __('messages.search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar -->
            <ul class="navbar-nav ml-auto">

                {{-- Language Switcher --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="langDropdown">
                        <a class="dropdown-item" href="{{ url('lang/en') }}">English</a>
                        <a class="dropdown-item" href="{{ url('lang/ar') }}">العربية</a>
                    </div>
                </li>

                {{-- User Menu --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item"
                            href="{{ route('adminProfile', Auth::user()->id) }}">{{ __('messages.profile') }}</a>
                        <a class="dropdown-item" href="/">{{ __('messages.goweb') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('messages.logout') }}
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/img/clickandcollect.jpg') }}" class="brand-image img-circle elevation-3">
                <span class="brand-text">{{ __('messages.dashboard') }}</span>
            </a>

            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('adminProfile', Auth::user()->id) }}"
                            class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>{{ __('messages.products') }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="{{ route('allproductsforadmin') }}"
                                        class="nav-link"><i
                                            class="far fa-circle nav-icon"></i>{{ __('messages.allproducts') }}</a>
                                </li>
                                <li class="nav-item"><a href="{{ route('prodtableadmin') }}" class="nav-link"><i
                                            class="far fa-circle nav-icon"></i>{{ __('messages.anotherView') }}</a>
                                </li>
                                <li class="nav-item"><a href="{{ route('addproduct') }}" class="nav-link"><i
                                            class="far fa-circle nav-icon"></i>{{ __('messages.createprod') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>{{ __('messages.category') }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a href="{{ route('categoriesforadmin') }}" class="nav-link"><i
                                            class="far fa-circle nav-icon"></i>{{ __('messages.category') }}</a></li>
                                <li class="nav-item"><a href="{{ route('addcategory') }}" class="nav-link"><i
                                            class="far fa-circle nav-icon"></i>{{ __('messages.createcategory') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <h1 class="m-0">@yield('title')</h1>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer text-center py-3 bg-light border-top">
            <div class="container">
                <p class="mb-1">{{ __('messages.footer_about_text') }}</p>
                <small>
                    &copy; {{ date('Y') }} <span class="text-primary">Salah</span> –
                    {{ __('messages.all_rights_reserved') }}
                </small>
                <div class="mt-2">
                    <a href="{{ url('lang/en') }}" class="text-decoration-none mx-1">English</a> |
                    <a href="{{ url('lang/ar') }}" class="text-decoration-none mx-1">العربية</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    @yield('js')
</body>

</html>
