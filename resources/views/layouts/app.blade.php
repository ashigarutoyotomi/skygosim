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
