@extends('layouts.app')

@section('text-title') Доставка @endsection

@section('script-section')
    <script>
        window.onload = function (){
            let fullPrice = 0
            document.querySelectorAll('.item-prices').forEach(item => {

                fullPrice += Number(item.dataset.price)
            })
            document.querySelector('#fullPrice').textContent = fullPrice.toString()
            console.log('Full price', fullPrice)
        }
    </script>
@endsection

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Ви замовляєте</h1>
                <!-- /.text-center -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        @foreach($data as $item)

            <div class="row my-2">
                <div class="col-md-3">
                    <img src="{{$item->product->image->main}}" class="img-thumbnail" alt="">
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                    <a href="{{product_link((int)$item->product->id)}}">
                        <h3>{{ $item->product->title }}</h3>
                    </a>
                   <p> {{strip_tags( $item->product->description)}} </p>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 d-flex align-items-center">
                    <span class="d-block price">
                       <span class="item-prices" data-price="{{$item->product->price->uan}}"> {{$item->product->price->uan}}</span>
                    </span>
                    <!-- /.d-block price -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row my-2 -->
        @endforeach
    </div>
    <!-- /.container mt-2 -->
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12 text-center">
                {{$data->links()}}
            </div>
            <!-- /.col-md-12 text-center -->
        </div>
        <!-- /.row -->

        <div class="row justify-content-center">
            <div class="col-md-8">
                <img
                    src="https://apimgmtstorelinmtekiynqw.blob.core.windows.net/content/MediaLibrary/Logo/logo-hor-ua.png"
                    alt="Нова пошта"
                    class="img-fluid my-3"
                >
                <h3>Адоеса доставки (Нова Пошта)</h3>
                <np-field phone-user="{{auth()->user()->userContact->phone}}">
                    @csrf
                </np-field>
            </div>
        </div>


    </div>
    <!-- /.container -->


@endsection
