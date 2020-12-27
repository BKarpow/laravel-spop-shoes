@extends('admin.layouts.app')

@section('text-title') Створення статусу замовлення @endsection

@section('content')
    <div class="container">
        <h2>Створення статусу</h2>
        <form action="{{route('statuses.create.action')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">І'мя статусу</label>
                <input type="text"
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
                ></textarea>
                <!-- /#.form-control -->
                @error('description')
                <div class="alert alert-warning">
                    <strong>Помилка в описі статусу</strong>
                </div>
                @enderror
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus-circle"></i>
                    Створити статус
                </button>
                <!-- /.btn -->
            </div>
            <!-- /.form-group -->
        </form>
    </div>
    <!-- /.container -->
@endsection
