@extends('admin.layouts.app')

@section('text-title') Адмін панель @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-8">
                <h2>Адмін панель</h2>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>Основне</h3>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="row flex-wrap">
                        <div class="col-md-6">
                            <Orders > </Orders>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6"></div>
                        <!-- /.col-md-6 -->
                        <div class="col-md-6"></div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.card col-8 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
