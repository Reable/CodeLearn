@extends('layout')

@section('title_name')
    Добавления языка программирования
@endsection

@section('script')
    <script>
        window.onload = function(){
            document.querySelector('input[type=button].add').addEventListener('click',add_languages)
            document.querySelector('input[type=button].delete').addEventListener('click',delete_language)

        }
        function add_languages(){
            let form = document.forms[0]
            let obj = JSON.stringify({
                'name':form.elements['name'].value,
                'creator':form.elements['creator'].value,
                'year_creation':form.elements['year_creation'].value,
            })

            let xhr = new XMLHttpRequest()
            xhr.open('POST','{{ route('add_languages') }}',true)
            xhr.setRequestHeader('Content-Type','application/json')
            xhr.setRequestHeader('X-CSRF-TOKEN','{{ csrf_token() }}')
            xhr.onreadystatechange = function (){
                if(xhr.readyState !== 4) return
                let data = JSON.parse(xhr.responseText)
                document.querySelectorAll('p.error').forEach(elem => elem.innerHTML = '')
                switch(xhr.status){
                    case 200:
                        document.querySelector('div.message').innerHTML = data.message
                        document.querySelectorAll('input[type=text]').forEach(elem => elem.value = '')
                        update_all_languages(data.languages)
                    break
                    case 422:
                        for(key in data.errors){
                            document.getElementById(key).innerHTML = data.errors[key][0]
                        }
                    break
                }
            }
            xhr.send(obj)
            return false
        }
        function update_all_languages(languages){
            let out = `<option value="-1">Выберите язык программирования</option>`
            languages.forEach(elem => {
                out += `
                    <option value="${elem.language_id}">${elem.name}</option>
                `
            })
            document.querySelector('form select').innerHTML = out
        }
        function delete_language(){
            let language_id = document.querySelector('select').value
            if(language_id === '-1') return alert('Этот элемент нельзя удалить')
            let xhr = new XMLHttpRequest()
            xhr.open('get','{{route('delete_language')}}?language_id='+language_id,true)
            xhr.onreadystatechange = function(){
                if(xhr.readyState !== 4) return
                let data = JSON.parse(xhr.responseText)
                document.querySelector('div.message').innerHTML = data.message
                update_all_languages(data.languages)
            }
            xhr.send()
            return false
        }
    </script>
@endsection

@section('main')
    <div class="languages">
        <div class="container">
            <h1>Добавления языка</h1>
            <form>
                <p class="error" id="name"></p>
                <input type="text" name="name" placeholder="Имя языка">

                <p class="error" id="creator"></p>
                <input type="text" name="creator" placeholder="Имя создателя языка">

                <p class="error" id="year_creation"></p>
                <input type="text" name="year_creation" placeholder="Год создания языка( тип ввода: 2021-12-12 )">

                <input type="button" class="add" value="Добавить язык программирования">
            </form>
            <br><br>
            <h2>Удаление языка программирования</h2>
            <form>
                <p class="error" id="year_creation"></p>
                <select name="language_id">
                    <option value="-1" selected disabled>Выберите язык программирования</option>
                    @foreach($data['lang'] as $val)
                        <option value="{{ $val->language_id }}">{{ $val->name }}</option>
                    @endforeach
                </select>
                <input type="button" class="delete" value="Удалить язык программирования">
            </form>
        </div>
    </div>
@endsection
