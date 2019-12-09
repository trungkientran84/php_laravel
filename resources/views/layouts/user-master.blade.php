<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <title>@yield('page_title', setting('admin.title') . " - " . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">

    <!-- Few Dynamic Styles -->
    <style type="text/css">
        .voyager .side-menu .navbar-header {
            background: {{ config('voyager.primary_color','#22A7F0') }};
            border-color: {{ config('voyager.primary_color','#22A7F0') }};
        }

        .widget .btn-primary {
            border-color: {{ config('voyager.primary_color','#22A7F0') }};
        }

        .widget .btn-primary:focus, .widget .btn-primary:hover, .widget .btn-primary:active, .widget .btn-primary.active, .widget .btn-primary:active:focus {
            background: {{ config('voyager.primary_color','#22A7F0') }};
        }

        .voyager .breadcrumb a {
            color: {{ config('voyager.primary_color','#22A7F0') }};
        }
    </style>
    <!--Custom style specific for user dashboard-->
    <link rel="stylesheet" href="css/profile.css">
    @yield('head')
</head>

<body class="voyager">

    <!--The progress spinning icon on page loading-->
    <div id="voyager-loader">
        <?php $admin_loader_img = Voyager::setting('admin.loader', ''); ?>
        @if($admin_loader_img == '')
            <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Voyager Loader">
        @else
            <img src="{{ Voyager::image($admin_loader_img) }}" alt="Voyager Loader">
        @endif
    </div>

    <?php
    /**
     * Getting user avatar image url which is used in slide bar and menu bar
     */
    if (\Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'http://') || \Illuminate\Support\Str::startsWith(Auth::user()->avatar, 'https://')) {
        $user_avatar = Auth::user()->avatar;
    } else {
        $user_avatar = Voyager::image(Auth::user()->avatar);
    }
    ?>

    <div class="app-container">
        <div class="fadetoblack visible-xs"></div>
        <div class="row content-container">
        @include('dashboard.navbar')
        @include('dashboard.sidebar')
        <!--Call javascript function to positioning the slide bar and top menu bar -->
            <script type="text/javascript" src="js/slide-menu-bar.js"></script>

            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    @yield('page_header')
                    <div id="voyager-notifications"></div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript Libs -->
    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="{{ voyager_asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <!--Additional javascript from extended pages-->
    @yield('javascript')
    @stack('javascript')
</body>
</html>
