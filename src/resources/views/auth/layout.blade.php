<!doctype html>
<html>
<head>
    <title>Authenticate</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/bootstrap/css/bootstrap-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/vendor/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap-3.3.7.min.js') }}"></script>
</head>
<body class="{{$route_body_classes}}">
<div class="row">
    <?php
    //dd($route_body_classes);
    ?>
    @yield('content')
</div>
</body>
</html>