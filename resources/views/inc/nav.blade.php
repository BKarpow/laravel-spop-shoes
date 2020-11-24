<div class="container-fluid py-1" id="top-nav">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <ul class="list-inline my-3">
                    <li class="list-inline-item">Контакти</li>
                    <li class="list-inline-item">Карта сайту</li>
                    <li class="list-inline-item"> Популярні</li>
                </ul>
            </div>
            <!-- /.col-md-6 -->
            <div class="col-md-6 my-1 d-flex align-items-center" style="flex-direction: row-reverse;">

                <search-component></search-component>
                <span class="icon-min">
{{--                    <i class="fas fa-shopping-cart"></i>--}}

                </span>
                <!-- /.icon-min -->
                <span class="icon-min" title="{{__('My likes')}}">
                    <a href="{{route('likes.my')}}">
                    <i class="fas fa-heart"></i>
                        </a>
                </span>
                <!-- /.icon-min -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>
<!-- /#top-nav.container-fluid -->

<div class="container my-2">
    <div class="row">
        <nav-bar-category></nav-bar-category>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col py-4">
            <h1>Cart</h1>
            <cart></cart>
        </div>
        <!-- /.col py-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.container my-2 -->

{{--<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--    <div class="container">--}}
{{--        <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--            {{ config('app.name', 'Laravel') }}--}}
{{--        </a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}

{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <!-- Left Side Of Navbar -->--}}
{{--            <ul class="navbar-nav mr-auto">--}}

{{--            </ul>--}}

{{--            <!-- Right Side Of Navbar -->--}}
{{--            <ul class="navbar-nav ml-auto">--}}
{{--                <!-- Authentication Links -->--}}
{{--                @guest--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                    </li>--}}
{{--                    @if (Route::has('register'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->name }}--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                {{ __('Logout') }}--}}
{{--                            </a>--}}

{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endguest--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}


