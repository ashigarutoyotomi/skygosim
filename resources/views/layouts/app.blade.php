<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkyGo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap.addons.css" rel="stylesheet">
    <link href="/css/animations.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
    <link href="/css/shop.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="preloader">
        <div class="preloader_image"></div>
    </div>

    <div id="app">
        <div id="canvas">
            <div id="box_wrapper">
{{--                <div class="header_absolute header_layout_1">--}}
{{--                    <!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->--}}
{{--                    <header class="page_header ls justify-nav-end">--}}
{{--                        <div class="container-fluid">--}}
{{--                            <div class="row align-items-center">--}}
{{--                                <div class="col-xl-2 col-lg-4 col-md-5 col-11">--}}
{{--                                    <a href="/" class="logo">--}}
{{--                                        <img class="py-20" src="/images/skygo_logo.png" alt="">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-10 col-lg-8 col-md-7 col-1">--}}
{{--                                    <div class="nav-wrap">--}}

{{--                                        <!-- main nav start -->--}}
{{--                                        <nav class="top-nav">--}}
{{--                                            <ul class="nav sf-menu">--}}
{{--                                                <li class="{{ (request()->is('/')) ? 'active' : '' }}">--}}
{{--                                                    <a href="/">Home</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="{{ (request()->is('/add-sim')) ? 'active' : '' }}">--}}
{{--                                                    <a href="/add-sim">Add Sim</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="{{ (request()->is('/packages')) ? 'active' : '' }}">--}}
{{--                                                    <a href="/packages">Packages</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="{{ (request()->is('/how-to')) ? 'active' : '' }}">--}}
{{--                                                    <a href="/how-to">How To</a>--}}
{{--                                                </li>--}}

{{--                                                <li class="{{ (request()->is('/faq')) ? 'active' : '' }}">--}}
{{--                                                    <a href="/faq">FAQ</a>--}}
{{--                                                </li>--}}

{{--                                                <li>--}}
{{--                                                    <a href="#">|</a>--}}
{{--                                                </li>--}}

{{--                                                @guest--}}
{{--                                                    @if (Route::has('login'))--}}
{{--                                                        <li class="{{ (request()->is('/login')) ? 'active' : '' }}">--}}
{{--                                                            <a href="/login">Log In</a>--}}
{{--                                                        </li>--}}
{{--                                                    @endif--}}

{{--                                                    @if (Route::has('register'))--}}
{{--                                                        <li class="{{ (request()->is('/register')) ? 'active' : '' }}">--}}
{{--                                                            <a href="/register">Register</a>--}}
{{--                                                        </li>--}}
{{--                                                    @endif--}}
{{--                                                @else--}}
{{--                                                    <li>--}}
{{--                                                        <a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>--}}
{{--                                                        <ul>--}}
{{--                                                            <li>--}}
{{--                                                                <a href="{{ route('logout') }}"--}}
{{--                                                                   onclick="event.preventDefault();--}}
{{--                                                                    document.getElementById('logout-form').submit();"--}}
{{--                                                                >--}}
{{--                                                                    {{ __('Logout') }}--}}
{{--                                                                </a>--}}

{{--                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                                                    @csrf--}}
{{--                                                                </form>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </li>--}}
{{--                                                @endguest--}}
{{--                                            </ul>--}}
{{--                                        </nav>--}}

{{--                                        <!--hidding includes on small devices. They are duplicated in topline-->--}}
{{--                                        <ul class="top-includes d-none d-xl-block search-icon">--}}

{{--                                            <li>--}}
{{--                                                <!--modal search-->--}}
{{--                                                <span>--}}
{{--												<a href="#" class="search_modal_button">--}}
{{--													<i class="fa fa-search"></i>--}}
{{--												</a>--}}
{{--											</span>--}}

{{--                                            </li>--}}

{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <span class="toggle_menu"><span></span></span>--}}
{{--                    </header>--}}
{{--                </div>--}}

                @if(Auth::user())
                    <navbar
                        :user="{{Auth::user()}}"
                    ></navbar>
                @else
                    <navbar></navbar>
                @endif

                @yield('content')

                <foot></foot>

                <section class="page_copyright ds s-py-10 copyright-bg">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="divider-15 d-none d-lg-block"></div>
                            <div class="col-md-12 text-center">
                                <p>&copy; Copyright <span class="copyright_year">2021</span> All Rights Reserved</p>
                            </div>
                            <div class="divider-15 d-none d-lg-block"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.addons.js" defer></script>
    <script src="/js/compressed.js" defer></script>
    <script src="/js/main.js" defer></script>
</body>
</html>
