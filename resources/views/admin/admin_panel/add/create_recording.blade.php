@extends('layout')

@section('title_name') Добавление урока @endsection

@section('main')
    <div class="add_recording">
        <div class="container">
            <div class="block">
                <h1 class="center">Добавление записи</h1>
                <form enctype="multipart/form-data" action="{{route('add_recording')}}" method="POST">
                    {{csrf_field()}}
                    <p class="error">{{ $errors->add_recording->first('title') }}</p>
                    <input type="text" name="title" placeholder="Введите заглавие">

                    <p class="error">{{ $errors->add_recording->first('chapters') }}</p>
                    <select name="chapters">
                        <option selected disabled>Выберите язык програмирования</option>
                        @foreach($data['chapters'] as $val)
                            <option value="{{ $val->title }}">{{ $val->title }}</option>
                        @endforeach
                    </select>

                    <p class="error">{{ $errors->add_recording->first('language') }}</p>
                    <select name="language">
                        <option selected disabled>Выберите язык програмирования</option>
                        @foreach($data['language'] as $val)
                            <option value="{{ $val->name }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                    <p class="error">{{ $errors->add_recording->first('image') }}</p>
                    <h2>Выберите картинку</h2>
                    <input type="file" name="image" placeholder="Выберите картинку">
                    <p class="error">{{ $errors->add_recording->first('learning_text') }}</p>
                    <h2>Введите обучающийся текст</h2>
                    <textarea name="learning_text"></textarea>
                    <input type="submit" value="Добавить запись">
                </form>
            </div>
        </div>
    </div>
@endsection
