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
<body class="{{ Route2Class::generateClassString() }}">
<div class="row">
    @yield('content')
</div>
</body>
</html>