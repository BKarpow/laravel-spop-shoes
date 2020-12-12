@extends('layouts.app')

@section('text-title') {{$data['title']}} @endsection

@section('meta-description'){{substr( strip_tags($data['description']), 0, 200)  }}@endsection
@section('meta-title'){{substr(strip_tags($data['title']), 0, 200)}}@endsection
@section('meta-image'){{asset( $data['main'])}}@endsection
@section('meta-url'){{product_link((int)$data['id'], true)}}@endsection

@section('style-section')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .swiper-container {
            width: 300px;
            height: 210px;
        }
    </style>
@endsection

@section('script-section')
    <script type="module">
        import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'

        let image_src = ''
        const swiper = new Swiper('.swiper-container', {
            // Optional parameters
            loop: true,
            autoHeight: true,
            effect: 'coverflow'
        })

        const swiper_g = new Swiper('.swiper-container-g', {
            // Optional parameters
            loop: true,
            autoHeight: true,
            effect: 'slide'
        })

        document.querySelectorAll('.swiper-slide').forEach(item => {
            item.addEventListener('click', function(ev){
                image_src = ev.target.dataset.large
                document.getElementById('big').src = image_src
                document.getElementById('big-link').href = image_src
                $('#GalleryBox').modal('toggle')
            })
        })

        document.querySelectorAll('.mini-img').forEach(item => {
            item.addEventListener('click', function(ev){
                const indexSlide = ev.target.dataset.index
                console.log(indexSlide)
                swiper.slideTo(indexSlide)
            })
        })
    </script>

{{--    <script--}}
{{--        src="https://code.jquery.com/jquery-1.12.4.min.js"--}}
{{--        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="--}}
{{--        crossorigin="anonymous" defer></script>--}}
{{--    <script src="/public/js/zoom.js" defer></script>--}}
{{--    <script>--}}
{{--        jQuery(function($){--}}
{{--            $(".zoom").imagezoomsl();--}}
{{--        });--}}
{{--    </script>--}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4" id="image">


<!-- Swiper -->
    <!-- Slider main container -->
    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img
                    src="{{$data['main']}}"
                    alt="{{$data['title']}}"
                    data-large="{{$data['main']}}"
                    class="zoom img-fluid m-2"
                    title="{{$data['title']}}"
                >
                <!-- /.img-fluid -->
            </div>
            @if (!empty($data['image_a']))
                <div class="swiper-slide">
                    <img
                        src="{{$data['image_a']}}"
                        alt="{{$data['title']}}"
                        data-large="{{$data['image_a']}}"
                        class="zoom img-fluid m-2"
                        title="{{$data['title']}}"
                    >
                    <!-- /.img-fluid -->
                </div>
            @endif
            @if (!empty($data['image_b']))
                <div class="swiper-slide">
                    <img
                        src="{{$data['image_b']}}"
                        alt="{{$data['title']}}"
                        data-large="{{$data['image_b']}}"
                        class="zoom img-fluid m-2"
                        title="{{$data['title']}}"
                    >
                    <!-- /.img-fluid -->
                </div>
            @endif
            @if (!empty($data['image_c']))
                <div class="swiper-slide">
                    <img
                        src="{{$data['image_c']}}"
                        alt="{{$data['title']}}"
                        data-large="{{$data['image_c']}}"
                        class="zoom img-fluid m-2"
                        title="{{$data['title']}}"
                    >
                    <!-- /.img-fluid -->
                </div>
            @endif

        </div>
    </div>
<!-- #Swiper -->

                <div class="img-mini-box d-flex py-2 px-1 mt-3 justify-content-around">
                    <div class="mr-2" style="width: 25%;">
                        <img src="{{$data['main']}}"  data-index="1" class="img-fluid mini-img" >
                        <!-- /.img-fluid -->
                    </div>
                    <!-- /.mr-2 -->
                    @if (!empty($data['image_a']))
                        <div class="mr-2" style="width: 25%;">
                            <img src="{{$data['image_a']}}"  data-index="2" class="img-fluid mini-img" >
                            <!-- /.img-fluid -->
                        </div>
                        <!-- /.mr-2 -->
                    @endif
                    @if (!empty($data['image_b']))
                        <div class="mr-2" style="width: 25%;">
                            <img src="{{$data['image_b']}}"  data-index="3" class="img-fluid mini-img" >
                            <!-- /.img-fluid -->
                        </div>
                        <!-- /.mr-2 -->
                    @endif
                    @if (!empty($data['image_c']))
                        <div class="mr-2" style="width: 25%;">
                            <img src="{{$data['image_c']}}"  data-index="4" class="img-fluid mini-img" >
                            <!-- /.img-fluid -->
                        </div>
                        <!-- /.mr-2 -->
                    @endif
                </div>
                <!-- /.img-mini-box -->
            </div>
            <!-- /#image.col-md-4 -->
            <div class="col-md-8" id="productInfo">
                <span class="category-tree">
                  Категорія:  {{$data['category_title']}}
                </span>
                <!-- /.category-tree -->
                <h2>{{$data['title']}}</h2>
                <p class="price">
                    Ціна {{$data['price']}} грн.
                </p>
                <!-- /.price -->

                <div class="order-form">
                    <order-form
                        product-id="{{$data['id']}}"
                        @if (auth()->check() && auth()->user()->userContact)
                            user-phone="{{auth()->user()->userContact->phone}}"
                            @endif
                    ></order-form>
                </div>
                <!-- /.order-form -->
                <div class="add-to-cart-form my-2">
                    <add-to-cart
                        ref="add"
                        @trigger="incrementTriggerCart" product-id="{{$data['id']}}"
                        @if (!auth()->check())
                            auth="0"
                        @else
                            auth="1"
                            @endif
                    ></add-to-cart>
                </div>
                <!-- /.add-to-cart-form -->
                <div class="like-box">
                    <like-box product-id="{{$data['id']}}" auth="{{(int)auth()->check()}}">
                        {{__('Додати в улюблене: ')}}
                    </like-box>
                </div>
                <!-- /.like-box -->
                <div class="product-attributes">
{{--                    <h4>Параметри товару</h4>--}}
{{--                    <ul class="list-group">--}}
{{--                        @foreach($data['attr'] as $attr)--}}
{{--                            <li class="list-group-item">--}}
{{--                                <strong>{{$attr['name']}}:</strong>&nbsp;--}}
{{--                                {{$attr['value']}}--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
                </div>
                <!-- /.product-attributes -->
            </div>
            <!-- /#productInfo.col-md-8 -->
        </div>
        <!-- /.row -->
        <div class="row my-3 justify-content-center">
            <div class="col-md-11">

                @if ($attr_g->count())
                    <h4>Параметри товару</h4>
                    <table class="table table-striped col-md-4">
                        <tbody>
                    @foreach($attr_g as $attribute)
                        <tr>
                            <th>{{  $attribute->title }}</th>
                            <td>{{$attribute->value}}</td>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                @endif
                <h4>Опис товару</h4>
                <p class="product-description">
                    {!!   $data['description'] !!}
                </p>
                <!-- /.product-description -->
            </div>
            <!-- /.col-md-11 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-10">
                @include('inc.comments.comments')
            </div>
            <!-- /.col-md-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Modal Gallery Box -->
    <div class="modal" id="GalleryBox" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Галерея товару</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="big-img">
                        <a id="big-link" href="" target="_blank">
                        <img src="" alt="" id="big" class="img-fluid">
                        </a>
                        <!-- /#big.img-fluid -->
                    </div>
                    <!-- /.big-img -->
                </div>
            </div>
        </div>
    </div>
    <!-- #Modal Gallery Box -->

@endsection
