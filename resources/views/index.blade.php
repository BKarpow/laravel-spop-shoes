@extends('layouts.app')

@section('text-title') Магазин взуття @endsection

@section('content')
    <div class="container">
        <div class="row flex-wrap">
            @foreach($data as $item)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <product-card
                        image="{{$item->image->main}}"
                        price="{{$item->price->uan}}"
                        currency="грн."
                        description="{{$item->description}}"
                        link="{{$item->path()}}"
                    >{{$item->title}}</product-card>
                </div>
                <!-- /.col-xs-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 -->
            @endforeach
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <div class="container">
        <div class="row">
            <div class="col">
                {{$data->links()}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
