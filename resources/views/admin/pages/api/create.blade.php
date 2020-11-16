@extends('admin.layouts.app')

@section('text-title') Створення нового API токена @endsection

@section('script-section')
    <script>
        const api_token = document.getElementById('apiToken');

        const CopyText = function(text){
            console.log(text); // Вивід тексту в консоль
            let cplCont = document.createElement('textarea'); // Створимо елемент
            cplCont.textContent = text; // додамо туди текст
            document.body.append(cplCont); // Додамо елемент до body
            cplCont.select(); // Виділемо весь текст в елементі
            document.execCommand('copy'); // Запустимо команду copy
            cplCont.remove(); // Видалимо обєкт
        }

        api_token.addEventListener('click', function (ev){
            console.log('Copy to bufer', ev.target.innerText)
            CopyText(ev.target.innerText)
            alert('Скопійовано в буфер ' + ev.target.innerText)
        })

    </script>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Створіть токен для доступу через API протокол</h2>
                <form action="{{route('api.token.create.action')}}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="createNewToken">
                    <button class="btn btn-primary">Створити токен</button>
                    <!-- /.btn btn-primary -->
                </form>

                @if (!empty(session('token')))
                    <h3>Ваш новий токен токен <span id="apiToken"> {{session('token')}}</span></h3>
                @endif
            </div>
            <!-- /.col-md-12 text-center -->
        </div>
        <!-- /.row -->
        <div class="row justify-content-center">
            <div class="col-md-11">
                <token-table-list></token-table-list>
            </div>
            <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
@endsection
