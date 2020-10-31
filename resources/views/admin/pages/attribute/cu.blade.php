@extends('admin.layouts.app')

@if (empty($data))
@section('text-title') Створити новий атрибут @endsection
@else
@section('text-title') Оновити атрибут {{$data->title}} @endsection
@endif





@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2>
                    @if (!empty($data))
                        Оновлення атрибуту
                    @else
                        Створення атрибуту
                    @endif
                </h2>
                <form
                    action="{{route('attribute.create.action')}}"
                    method="POST"
                >
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва атрибуту</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id="title"
                            placeholder="Назва атрибуту"
                            @if (!empty($data))
                            value="{{$data->title}}"
                            @endif
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label for="value">Значення атрибуту</label>
                        <textarea name="value" id="value" cols="30" rows="10" class="form-control"></textarea>
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
