@if (!empty(session('status')))
    <div class="alert alert-success my-3">
        <strong>
            {{ session('status') }}
        </strong>
    </div>
    <!-- /.alert my-3 -->
@endif

@if($errors->any())
    <div class="alert alert-danger my-2">
        <ul>
            @foreach($errors as $error)
                <li>
                    <strong>
                        {{$error}}
                    </strong>
                </li>
                @endforeach
        </ul>
    </div>
    <!-- /.alert -->
@endif
