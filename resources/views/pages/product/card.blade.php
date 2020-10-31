@extends('layouts.app')

@section('text-title') {{$data['title']}} @endsection

@section('meta-description') {{substr( strip_tags($data['description']), 0, 200)  }}@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4" id="image">
                <img src="{{$data['main']}}" alt="{{$data['title']}}" class="img-fluid m-2">
                <!-- /.img-fluid -->
            </div>
            <!-- /#image.col-md-4 -->
            <div class="col-md-8" id="productInfo">
                <h2>{{$data['title']}}</h2>
                <p class="price">
                    Ціна {{$data['price']}} грн.
                </p>
                <!-- /.price -->
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
    </div>
    <!-- /.container -->
@endsection
