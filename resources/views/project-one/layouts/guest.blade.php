<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('theme/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('theme/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('theme/admin-lte/dist/css/adminlte.min.css') }}">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body class="hold-transition login-page">
    @yield('content')
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('theme/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('theme/admin-lte/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('theme/admin-lte/dist/js/adminlte.min.js') }}"></script>

    @stack('scripts')
</body>

</html>
