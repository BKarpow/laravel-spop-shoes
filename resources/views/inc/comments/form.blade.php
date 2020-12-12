<form action="{{route('comment.new')}}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{$data['id']}}">
    <h4>Додати відгук</h4>
    <hr class="m-1">
    <div class="form-group mt-3">
        <h5></h5>
        <div class="rating-area">
        	<input type="radio" id="star-5" name="rating" value="5">
        	<label for="star-5" title="Оценка «5»"></label>
        	<input type="radio" id="star-4" name="rating" value="4">
        	<label for="star-4" title="Оценка «4»"></label>
        	<input type="radio" id="star-3" name="rating" value="3">
        	<label for="star-3" title="Оценка «3»"></label>
        	<input type="radio" id="star-2" name="rating" value="2">
        	<label for="star-2" title="Оценка «2»"></label>
        	<input type="radio" id="star-1" name="rating" value="1">
        	<label for="star-1" title="Оценка «1»"></label>
        </div>




    </div>
    <!-- /.form-group mt-3 -->
    <div class="form-group">
        <label for="name" >Ваше ім'я</label>
        <input
            type="text"
            class="form-control"
            name="name"
            id="name"
            maxlength="50"
            placeholder="Ваше ім'я"
        >
        <!-- /.form-control -->
    </div>
    <!-- /.form-group -->

    <div class="form-group">
        <label for="email">Ваш Email</label>
        <input type="email"
               name="email"
               id="email"
               maxlength="200"
               class="form-control"
               placeholder="Ваш Email"
        >
        <!-- /.form-control -->
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <label for="comment">Відгук</label>
        <textarea
            name="comment"
            id="comment"
            cols="30"
            rows="10"
            maxlength="1250"
            class="form-control"
            placeholder="Напишіть свій відгук"
        ></textarea>
        <!-- /#.form-control -->
    </div>
    <!-- /.form-group -->
    <div class="form-group">
        <button class="btn btn-success btn-block">Додати свій відгук</button>
        <!-- /.btn -->
    </div>
    <!-- /.form-group -->
</form>
