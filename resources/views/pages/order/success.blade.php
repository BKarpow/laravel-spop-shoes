@extends('layouts.app')

@section('text-title') Замовлення створено @endsection

@section('meta-description')  @endsection
@section('meta-title')  @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1><i class="fas fa-check-square display-4" style="color: darkolivegreen;"></i></h1>
                <h1>Замовлення створено, очікуйте дзвінка для уточнення замовлення.</h1>
                <p><a href="/" class="btn btn-outline-success btn-lg">
                        <i class="fas fa-arrow-left"></i> Назад до магазину
                    </a></p>
            </div>
            <!-- /.col-lg-10 text-center -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
