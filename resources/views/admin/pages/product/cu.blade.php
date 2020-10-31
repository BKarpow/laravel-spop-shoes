@extends('admin.layouts.app')

@if (empty($data))
    @section('text-title') Створити ноаий товар @endsection
@else
    @section('text-title') Оновити {{$data->title}} @endsection
@endif

@section('style-section')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('script-section')


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.editors').summernote({
                placeholder: 'Опис',
                tabsize: 2,
                height: 350,
                callbacks: {
                    onImageUpload: function (files) {
                        const el = $(this);
                        uploadFile(files[0], el);
                    }
                }
            });
        });

        const uploadFile = (file, el) => {
            const fData = new FormData()
            fData.append('image', file)
            axios.post('{{route('image.upload')}}', fData)
                .then(response => {
                    const path = response.data.path
                    console.log('File upload', path)
                    el.summernote('insertImage', path);
                })
                .catch(err => {
                    console.error(err)
                })
        }
    </script>
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2>
                    @if (!empty($data))
                        Оновлення товару
                    @else
                        Створення товару
                    @endif
                </h2>
                <form action="{{route('product.create.action')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Назва товару</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id="title"
                            placeholder="Назва товару"
                            @if (!empty($data))
                                value="{{$data->title}}"
                            @endif
                        >
                        <!-- /.form-control -->
                    </div>
                    <!-- /.form-group -->

                    <create-price create-price-url="{{route('price.ajax.create')}}"></create-price>

                    <create-image-box></create-image-box>

                    <selector-category
{{--                        default-category-id="1"--}}
                    ></selector-category>

{{--                    <attribute-component></attribute-component>--}}

                    <add-attribute-from-product></add-attribute-from-product>


                    <div class="form-group">
                        <label for="description">Опис товару</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="editors"></textarea>
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
