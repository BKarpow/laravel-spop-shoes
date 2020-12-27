@extends('admin.layouts.app')

@section('text-title') Редагування {{$item->title}} @endsection

@section('content')
    <div class="container">
        <h2>Створення статусу</h2>
        <form action="{{route('statuses.update.action')}}" method="POST">
            @csrf
            <input type="hidden" name="status_id" value="{{$item->id}}">
            <div class="form-group">
                <label for="title">І'мя статусу</label>
                <input type="text"
                       value="{{$item->title}}"
                       name="title"
                       placeholder="І'мя статусу"
                       id="title"
                       class="form-control @error('title') error-border @enderror">
                <!-- /.form-control -->
                @error('title')
                <div class="alert alert-warning">
                    <strong>Помилка в назві статусу</strong>
                </div>
                @enderror
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label for="color">Виберіть колір статусу</label>
                <input type="text"
                       name="color"
                       value="{{$item->color}}"
                       placeholder="Клацніть для вибору"
                       id="color"
                       data-jscolor=""
                       class="form-control @error('color') error-border @enderror">
                <!-- /.form-control -->
                @error('color')
                <div class="alert alert-warning">
                    <strong>Помилка в значенні кольору</strong>
                </div>
                @enderror
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label for="description">Опис статусу</label>
                <textarea name="description"
                          id="description"
                          cols="30"
                          rows="10"
                          class="form-control @error('description') error-border @enderror"
                          placeholder="Опишіть ствтус"
                >{{$item->description}}</textarea>
                <!-- /#.form-control -->
                @error('description')
                <div class="alert alert-warning">
                    <strong>Помилка в описі статусу</strong>
                </div>
                @enderror
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-edit"></i>
                    Редагувати статус
                </button>
                <!-- /.btn -->
            </div>
            <!-- /.form-group -->
        </form>
    </div>
    <!-- /.container -->
@endsection
