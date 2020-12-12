

<section class="container">
    <div class="row">


        <div class="col-md-12">
            @error('name')
            <div class="alert alert-danger">
                <strong>Помилка в імені</strong>
            </div>
            @enderror
            @error('email')
            <div class="alert alert-danger">
                <strong>Помилка в email</strong>
            </div>
            @enderror
            @error('comment')
            <div class="alert alert-danger">
                <strong>Помилка в message</strong>
            </div>
            @enderror
            @error('product_id')
            <div class="alert alert-danger">
                <strong>Помилка в product id.</strong>
            </div>
            @enderror
            @error('rating')
            <div class="alert alert-danger">
                <strong>Помилка в rating</strong>
            </div>
            @enderror
            @if(auth()->check())
                <form action="{{route('comment.new')}}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="{{auth()->user()->name}}">
                    <input type="hidden" name="email" value="{{auth()->user()->email}}">
                    <input type="hidden" name="product_id" value="{{$data['id']}}">
                    <input type="hidden" name="rating" value="3">
            <div class="panel">
                <div class="panel-body">
                    <textarea
                        class="form-control"
                        name="comment"
                        rows="2"
                        placeholder="Додати Ваш коментар"
                    ></textarea>
                    <div class="mar-top clearfix">
                        <button class="btn btn-sm btn-primary pull-right" type="submit">
                            <i class="fa fa-pencil fa-fw"></i> Додати
                        </button>

                    </div>
                </div>
            </div>
                </form>
            @else

                <div class="panel">
                    <div class="panel-body">
                        <p>Тільки авторизовані користувачі можуть залишати відгуки</p>
                        <a href="/login" class="btn btn-primary">Увійти</a>
                        <div class="mar-top clearfix">


                        </div>
                    </div>
                </div>

            @endif


            @foreach($comments as $comment)
            <div class="panel">
                <div class="panel-body">
                    <div class="media-block">
                        <a class="media-left" href="#">
                            <img
                                class="img-circle img-sm"
                                alt="Профиль пользователя"
                                src="https://bootstraptema.ru/snippets/icons/2016/mia/1.png"></a>
                        <div class="media-body">
                            <div class="mar-btm">
                                <a href="#" class="btn-link text-semibold media-heading box-inline">
                                    {{$comment->name}}
                                </a>
                                <p class="text-muted text-sm">
                                    <i class="fa fa-mobile fa-lg"></i>
                                    - {{date('H:i (d-m-Y)', strtotime($comment->created_at))}}
                                </p>
                            </div>
                            <p>
                                {{$comment->comment}}
                            </p>
                            <div class="pad-ver">

                            </div>
                            <hr>

                            <div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
                @endforeach
        </div>
        <div class="panel">
            {{$comments->links()}}
        </div>
    </div><!-- /.row -->
</section><!-- /.container -->
