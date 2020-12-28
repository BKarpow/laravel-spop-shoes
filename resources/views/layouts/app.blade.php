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
    <nav id="menu">
        @include('inc.nav')
    </nav>
    <!-- /#menu -->
    <div id="app">

        <div class="container">
            <div class="row">
                <div class="col-md-2 py-2">
                    <button class="btn btn-outline-dark btn-lg menu-toggle">
                        <i class="fas fa-bars"></i>
                        Меню
                    </button>
                    <!-- /.btn -->
                </div>
                <!-- /.col-md-2 py-2 -->
                <div class="col-md-4 py-2">
                    <div class="btn-group">
                        <a href="{{route('likes.my')}}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-heart"></i>
                        </a>
                        <cart @cart-product-remove="removeFromCart" ref="cart"></cart>
                        <!-- /.btn -->
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.col-md-4 py-2 -->
                <div class="col-md-4 py-2">
                    <search-component></search-component>
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <div class="container my-2">
            <div class="row">
                <nav-bar-category></nav-bar-category>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container my-2 -->

        @yield('alert')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@yield('script-section')
    <script>

    </script>
</body>
</html>
<script>
    import CartModal from "../../js/components/CartModal";
    export default {
        components: {CartModal}
    }
</script>
