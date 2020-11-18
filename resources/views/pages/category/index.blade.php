@extends('layouts.app')

@section('text-title') Категорія @endsection

@section('content')
    <div class="container">
        <div class="container my-2">
            <div class="row">
                <div class="col-md-9">
                    @if (!empty($children))
                    <h2>Підпорядковані</h2>
                    <ul>
                        @foreach($children as $chi)
                        <li>{{$chi->title}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.col-md-9 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container my-2 -->
        <div class="row flex-wrap">
            @foreach($data as $item)
                <div class="col-md-3">
                    <!-- ['image', 'price', 'currency', 'description', 'link'] -->
                    <product-card
                        image="{{$item['main']}}"
                        price="{{$item['price']}}"
                        currency="грн."
                        description="{{$item['description']}}"
                        link="/product/{{$item['id'].'-'.$item['alias'].'.html'}}"
                    >
                        {{$item['title']}}
                    </product-card>
                </div>
                <!-- /.col-md-3 -->
            @endforeach
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
