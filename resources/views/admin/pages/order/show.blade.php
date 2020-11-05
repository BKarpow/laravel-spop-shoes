@extends('admin.layouts.app')


@section('text-title')Замовлення {{$data['id']}} @endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Замовлення {{$data['id']}}</h3>
                <table class="table">
                    <tbody>
                    <tr>
                        <th>Статус</th>
                        <td>{{$data['status']}}</td>
                    </tr>
                    <tr>
                        <th>Замовлено</th>
                        <td>{{$data['created_at']}}</td>
                    </tr>
                    <tr>
                        <th>Ім'я</th>
                        <td>{{$data['user_name']}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$data['user_email']}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$data['user_phone']}}</td>
                    </tr>
                    <tr>
                        <th>Comment</th>
                        <td>{{$data['user_comment']}}</td>
                    </tr>
                    <tr>
                        <th>Product</th>
                        <td><a href="{{route('product.show', ['product_alias'=>$data['product_id']])}}">
                                {{$data['title']}}
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

@endsection
