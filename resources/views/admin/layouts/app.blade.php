<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('text-title')</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->


    @if (env('APP_DEBUG', false))
        <link
            href="{{ asset('/public/css/admin/app_admin.css').'?hash='. md5_file($_SERVER['DOCUMENT_ROOT'].'/public/css/admin/app_admin.css') }}"
            rel="stylesheet"
        >
    @else
        <link
            href="{{ asset('/public/css/admin/app_admin.css') }}"
            rel="stylesheet"
        >
    @endif
<!-- FontAwessome CDN -->
    <link
        rel="stylesheet"
        href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
        crossorigin="anonymous"
    />
    @yield('style-section')
</head>
<body>
<div id="app">

    @yield('alert')
    <div class="container-fluid h-100">
        <div class="row align-items-stretch">
            <div class="col-lg-3" id="left_bar">
                @include('admin.inc.nav')
            </div>
            <!-- /#left_bar.col-lg-3 -->
            <div class="col-lg-9" id="content">
                @include('admin.inc.alert')
                @yield('content')
            </div>
            <!-- /#content.col-lg-9 -->
        </div>
        <!-- /.row-fluid -->
    </div>
    <!-- /.container-fluid -->
</div>

<!-- Scripts -->
<script src="{{ asset('/public/js/admin/app_admin.js') }}"></script>

@yield('script-section')
</body>
</html>
