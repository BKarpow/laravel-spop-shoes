@extends('layouts.app')

@section('text-title') {{__('My likes')}} @endsection

@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col">
                <h1 class="text-center">{{__('List your likes')}}</h1>
                <!-- /.text-center -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        @foreach($data as $item)
            <div class="row my-2">
                <div class="col-md-3">
                    <img src="{{$item->image}}" class="img-thumbnail" alt="{{$item->title}}">
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4">
                    <a href="{{  product_link($item->pid) }}">
                    <h3>{{ $item->title }}</h3>
                    </a>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 d-flex align-items-center">
                    <span class="d-block price">
                        {{$item->price}}
                    </span>
                    <!-- /.d-block price -->
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row my-2 -->
        @endforeach
    </div>
    <!-- /.container mt-2 -->
@endsection
