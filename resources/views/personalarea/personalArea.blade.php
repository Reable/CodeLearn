@extends('layout')
{{--Присванвание имени страницы--}}
@section('title_name')Личный кабинет@endsection

@section('script')
    <script>
        window.onload = function(){
            document.querySelector('.setting .link a').addEventListener('click',()=>{
                info()
            })
        }
        function info(){
            let xhr = new XMLHttpRequest()
            xhr.open('get','{{ route('update_profile_input') }}',true)
            xhr.onreadystatechange = function(){
                if(xhr.readyState !== 4) return
                let data = JSON.parse(xhr.responseText)
                document.querySelector('div.info').innerHTML =
                    `
                        <div class="image">
                            <h2>Выберите изображение</h2><input name="image" type='file'>
                        </div>
                        <div class="name">
                            <form>
                                <h2>Ваше имя:</h2> <input type='text' name="name" value='${ data.user.name }' placeholder='Введите новое имя'>
                                <h2>Ваша фамилия:</h2><input type='text' name="surname" value='${ data.user.surname }' placeholder='Введите новое имя'>
                                <input type="button" id="updateData" value="Изменить">
                            </form>
                        </div>
                    `
                document.getElementById('updateData').addEventListener('click',()=>{
                    let formName = document.forms[0]
                    let updateData = JSON.stringify({
                        'name':formName.elements['name'].value,
                        'surname':formName.elements['surname'].value,
                    })

                    profile_update(updateData)
                })
            }
            xhr.send()
            return false
        }

        function profile_update(updateData){
            let xhr = new XMLHttpRequest()
            xhr.open('POST','{{ route('update_profile') }}',true)
            xhr.setRequestHeader('Content-Type','application/json')
            xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
            xhr.onreadystatechange = function() {
                if (xhr.readyState !== 4) return
                let data = JSON.parse(xhr.responseText)
                get_info(data)
            }
            xhr.send(updateData)
            return false
        }

        function get_info(data){
            let role = ''
            let completed_course = ''
            //Роль участника
            if(data.user.role === '0'){
                role = 'Ученик'
            }else if(data.user.role === '1'){
                role = 'Администратор'
            }else if(data.user.role === '2'){
                role = 'Создатель'
            }
            //Проверка на изученные языки
            if(data.user.completed_course === null){
                completed_course = 'Отсутствуют'
            }else{
                completed_course = `${data.user.completed_course}`
            }

            document.querySelector('div.information').innerHTML = `
                <div class="info">
                    <div class="image">
                        <img src="public/${data.user.path_to_image}" name="image" alt="Image person">
                    </div>
                    <div class="name">
                        <h2>${data.user.name} ${data.user.surname}</h2>
                    </div>
                    <div class="learned">
                        <h2>Ваша роль: ${role}</h2>
                        <h2>Изученные языки: ${completed_course}</h2>
                    </div>
                </div>
            `
        }
    </script>
@endsection

@section('main')
    <div class="personal_area">
        <div class="container">
            <div class="personal_information">
                @foreach($data as $val)
                    <div class="information">
                        <div class="info">
                            <div class="image">
                                <img src="{{ asset('public/'.$val->path_to_image) }}" name="image" alt="Image person">
                            </div>
                            <div class="name">
                                <h2>{{ $val->name }} {{ $val->surname }}</h2>
                            </div>
                            <div class="learned">
                                @if($val->role == 0)
                                    <h2>Ваша роль: Ученик</h2>
                                @elseif($val->role == 1)
                                    <h2>Ваша роль: Администратор</h2>
                                @elseif($val->role == 2)
                                    <h2>Ваша роль: Создатель</h2>
                                @endif
                                <h2>Изученные языки:
                                    @if($val->copleted_course == '')
                                        Отсутствуют
                                    @else
                                        {{ $val->completed_course }}
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="setting">
                        <div class="center"><h3>Настройки</h3></div>
                        <nav class="center">
                            <a>Редактировать профиль</a>
                                @if($val->role == 1 || $val->role == 2)
{{--                                    Ссылки только для администраторов и Создателя--}}
                                    <a href="{{ route('admin_panel_page') }}">Панель администрирования</a>
                                @elseif($val->role == 2)
{{--                                    Ссылки только для Создателя--}}
                                @endif
                            <a class="logout" href="{{ route('logout') }}">Выход</a>
                        </nav>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
