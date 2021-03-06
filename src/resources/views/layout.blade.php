<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>
        {{ isset($title) ? $title.' :: '.config('allay.base.project_name').' Admin' : config('allay.base.project_name').' Admin' }}
    </title>

    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/allay/pnotify/pnotify.custom.min.css') }}">

    <!-- Allay Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/allay/allay.base.css') }}">

    @yield('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition {{ config('allay.base.skin') }} sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{!! config('allay.base.logo_mini') !!}</span>
            <!-- logo for regular state and mobile -->
            <span class="logo-lg">{!! config('allay.base.logo_lg') !!}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">{{ trans('allay::base.toggle_navigation') }}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            @include('allay::inc.menu')
        </nav>
    </header>

    <!-- =============================================== -->

    @include('allay::inc.sidebar')

    <!-- =============================================== -->

    <!-- Page Content -->
    <div class="content-wrapper">
        <!-- Page Header -->
        @yield('header')

        <!-- Main Content -->
        <section class="content">
            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        @if (config('allay.base.show_powered_by'))
            <div class="pull-right hidden-xs">
                {{ trans('allay::base.powered_by') }}
                <a target="_blank" href="https://github.com/laravel-allay">Allay</a>
            </div>
        @endif
    </footer>
</div>


@yield('before_scripts')

<!-- jQuery 2.2.3 -->
<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
<script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
<script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>

<!-- page script -->
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart();
    });

    // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Set active state on menu element
    var current_url = "{{ url(Route::current()->getUri()) }}";
    $("ul.sidebar-menu li a").each(function () {
        if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href'))) {
            $(this).parents('li').addClass('active');
        }
    });
</script>

@include('allay::inc.alerts')

@yield('after_scripts')
@stack('before_body_end');
</body>
</html>
