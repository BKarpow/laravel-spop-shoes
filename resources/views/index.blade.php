@extends('layouts.app')

@section('text-title') Магазин взуття @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Нова колекція взуття</h2>
                <products-box></products-box>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
