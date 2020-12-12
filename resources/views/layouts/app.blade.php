<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('meta-description')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- OpenGraph -->
    {!!   getOpenGraph('locale', 'uk_UA') !!}
    {!!   getOpenGraph('type', 'website') !!}
    {!!   getOpenGraph('site_name', env('APP_NAME', '')) !!}
    <meta name="og:title" content="@yield('text-title')">
    <meta name="og:description" content="@yield('meta-description')">
    <meta name="og:image" content="@yield('meta-image')">
    <meta name="og:url" content="@yield('meta-url')">



    <title>@yield('text-title')</title>

    <!-- Scripts -->
    <script src="{{ asset('/public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->


   @if (env('APP_DEBUG', false))
        <link
            href="{{ asset('/public/css/app.css').'?hash='. md5_file($_SERVER['DOCUMENT_ROOT'].'/public/css/app.css') }}"
            rel="stylesheet"
        >
    @else
        <link
            href="{{ asset('/public/css/app.css') }}"
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
        @include('inc.nav')
        @yield('alert')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@yield('script-section')
</body>
</html>
