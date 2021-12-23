@extends('layout')

@section('title_name')Добавление глав @endsection

@section('main')
    <div class="add_chapters">
        <div class="container">
            <div class="block">
                <h1 class="center">Добавление главы</h1>
                <form enctype="multipart/form-data" action="{{route('add_chapters')}}" method="POST">
                    {{csrf_field()}}

                    <p class="error">{{ $errors->add_chapters->first('title') }}</p>
                    <input type="text" name="title" placeholder="Введите название главы">

                    <p class="error">{{ $errors->add_chapters->first('language') }}</p>
                    <select name="language">
                        <option selected disabled>Выберите язык програмирования</option>
                        @foreach($data['language'] as $val)
                            <option value="{{ $val->name }}">{{ $val->name }}</option>
                        @endforeach
                    </select>

                    <p class="error">{{ $errors->add_chapters->first('image') }}</p>
                    <h2>Выберите картинку</h2>
                    <input type="file" name="image" placeholder="Выберите картинку">

                    <input type="submit" value="Добавить главу">
                </form>
            </div>
        </div>
    </div>
@endsection
