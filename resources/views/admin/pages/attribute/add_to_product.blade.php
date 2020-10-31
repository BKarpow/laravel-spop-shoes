@extends('admin.layouts.app')


@section('text-title') Додати атрибут до товару @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="attribute_id">Атрибут</label>
                        <select name="attribute_id" id="attribute_id" class="form-control">
                            <option selected>Обрати Атрибут</option>
                            @foreach($attributes as $attr)
                                <option value="{{$attr->id}}">{{$attr->title.': '.trim($attr->value)}}</option>
                            @endforeach
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="product_id">Товар</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <option selected>Обрати Товар</option>
                            @foreach($products as $prod)
                                <option value="{{$prod->id}}">{{$prod->title}}</option>
                            @endforeach
                        </select>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.col-lg-10 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

@endsection
