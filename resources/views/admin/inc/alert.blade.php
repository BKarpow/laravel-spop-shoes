@if (!empty(session('status')))
    <div class="alert alert-success my-3">
        <strong>
            {{ session('status') }}
        </strong>
    </div>
    <!-- /.alert my-3 -->
@endif
