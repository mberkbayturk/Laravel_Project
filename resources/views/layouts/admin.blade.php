<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/images/logo.jpg') }}" type="image/x-icon">

    <!-- Styles -->
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/css/material-dashboard.css') }}">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.includes.adminNavbar')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.includes.adminFooter')
        </div>
    </main>
    
<!--   Core JS Files   -->
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('admin/js/material-dashboard.js') }}"></script>
<script src="{{ asset('admin/js/core/bootstrap.bundle.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session('status'))
    <script>
        swal("","{{session('status')}}", "success");
    </script>
@endif
  @yield('scripts')
</body>

</html>
