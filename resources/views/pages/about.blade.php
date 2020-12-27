@extends('layouts.app')

@section('text-title') Про магазин @endsection

@section('meta-description') Інтернет-магазин шкіряного взуття @endsection
@section('meta-title') Про магазин @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Про магазин</h2>

            </div>
            <!-- /.col-md-8 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3>Форма для зв`зку</h3>
                @if (session('status'))
                    <div class="alert alert-success my-2 px-1">
                        {{session('status')}}
                    </div>
                    <!-- /.alert my-2 px-1 -->
                @endif
                <form action="{{route('feedback.action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">
                            Ваше iм`я <i class="red fas fa-star-of-life"></i>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control"
                               placeholder="Як до Вас звертатимь?"
                        >
                        <!-- /.form-control -->
                        @error('name')
                            <div class="alert alert-warning my-2">
                                <strong>{{$message}}</strong>
                            </div>
                            <!-- /.alert -->
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="email">
                            Email <i class="red fas fa-star-of-life"></i>
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               placeholder="example@mail.ua"
                        >
                        <!-- /.form-control -->
                        @error('email')
                            <div class="alert alert-warning my-2">
                                <strong>{{$message}}</strong>
                            </div>
                            <!-- /.alert -->
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="phone">
                            Телефон
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               class="form-control"
                               placeholder="097 123 45 67"
                        >
                        <!-- /.form-control -->
                        @error('phone')
                        <div class="alert alert-warning my-2">
                            <strong>{{$message}}</strong>
                        </div>
                        <!-- /.alert -->
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="subject">Тема</label>
                        <input type="text"
                               name="subject"
                               id="subject"
                               class="form-control"
                               placeholder="Придумайте тему листа"
                        >
                        <!-- /.form-control -->
                        @error('subject')
                        <div class="alert alert-warning my-2">
                            <strong>{{$message}}</strong>
                        </div>
                        <!-- /.alert -->
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="message">
                            Повідомлення <i class="red fas fa-star-of-life"></i>
                        </label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>

                        <!-- /.form-control -->
                        @error('message')
                        <div class="alert alert-warning my-2">
                            <strong>{{$message}}</strong>
                        </div>
                        <!-- /.alert -->
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label for="captcha">Пройдiть перевiрку</label>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">
                            Вiдпрвити
                        </button>
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
