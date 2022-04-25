<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel | Project</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("assert/plugins/fontawesome-free/css/all.min.css")}}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("assert/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assert/dist/css/adminlte.min.css")}}">

    <link rel="stylesheet" href="{{asset('admin/css/image.css')}}">
{{--    <link rel="stylesheet" href="{{asset('admin/css/material.css')}}">--}}
    <link rel="stylesheet" href="{{asset("assert/plugins/select2/css/select2.min.css")}}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">


    @include('layouts.partials.preloader')
    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    @include('layouts.partials.footer')


</div>

<script src="{{asset("assert/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assert/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assert/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<script src="{{asset("assert/dist/js/adminlte.js")}}"></script>
<script src="{{asset("assert/plugins/jquery-mousewheel/jquery.mousewheel.js")}}"></script>
<script src="{{asset("assert/plugins/raphael/raphael.min.js")}}"></script>
<script src="{{asset("assert/plugins/jquery-mapael/jquery.mapael.min.js")}}"></script>
<script src="{{asset("assert/plugins/jquery-mapael/maps/usa_states.min.js")}}"></script>
<script src="{{asset("assert/plugins/chart.js/Chart.min.js")}}"></script>
<script src="{{asset("assert/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assert/dist/js/demo.js")}}"></script>
<script  src="{{asset("admin/js/CustomAlert.js")}}"></script>
<script  src="{{asset("admin/js/image.js")}}"></script>
<script  src="{{asset("admin/js/base.js")}}"></script>
<script  src="{{asset("admin/js/checkBox.js")}}"></script>
<script type="module" src="{{asset("admin/js/checkBox.js")}}"></script>
<script  src="{{asset("admin/js/category.js")}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('.select2').select2({
            allowClear: true
        })

    });
</script>
@stack('scripts')
</body>
</html>
