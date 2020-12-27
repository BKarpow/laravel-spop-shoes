@extends('admin.layouts.app')

@section('text-title') Статуси замовлень @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h2>Створені статуси</h2>
                <div class="btn-group">
                    <a href="{{route('statuses.create')}}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle"></i>
                        Створити статус
                    </a> &nbsp;
                </div>
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <h3>Статуси</h3>
                @if($data->count() == 0)
                    <div class="alert alert-info">
                        <strong>Поки немає статусів, створіть новий.</strong>
                    </div>
                @else
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Color</th>
                                <th>Desc</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->title}}</td>
                                    <td><span style="padding: 1rem;background: {{$item->color}};"></span></td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a
                                                href="{{route('statuses.update', ['status_id'=>$item->id])}}"
                                                class="btn btn-outline-primary"
                                                title="Редагувати">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('statuses.delete', ['status_id'=>$item->id])}}"
                                               class="btn btn-outline-danger" title="Видалити">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{$data->links()}}
                    </div>
                @endif

            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
