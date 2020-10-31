@extends('admin.layouts.app')

@if (empty($data))
@section('text-title') Створити нову категорію @endsection
@else
@section('text-title') Оновити категорію {{$data->title}} @endsection
@endif





@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2>
                    @if (!empty($data))
                        Оновлення категорії
                    @else
                        Створення категорії
                    @endif
                </h2>
                <form
                    action="{{route('category.create.action')}}"
                    method="POST"
                >
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва категорії</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id="title"
                            placeholder="Назва категорії"
                            @if (!empty($data))
                            value="{{$data->title}}"
                            @endif
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->

                        <create-image-box :one-box="true"></create-image-box>

                    <div class="form-group">
                        <label for="description">Опис категорії</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        <!-- /#.form-control -->
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <button class="btn btn-primary"><i class="fas fa-plus-circle"></i> Створити</button>
                        <!-- /.btn -->
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
