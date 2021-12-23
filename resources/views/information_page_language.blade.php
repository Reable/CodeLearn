@extends('layout')

@section('title_name')
    Обучение {{$data['language']->name}}
@endsection

@section('script')
    <script>

    </script>
@endsection

@section('main')
    <div class="all_info_by_learn">
        <div class="container">
            <div class="block">
                <div class="center h1"><h3>{{$data['language']->name}}</h3></div>
                @if(count($data['chapters']) >= 1)
                    <div class="chapters">
                        @foreach($data['chapters'] as $val)
                            <div class="chapter">
                                <p class="h2">{{ $val->chapter_number }}) {{$val->title}}</p>
                                <ul>
                                    @foreach($data['recordings'] as $record)
                                        @if($record->chapters == $val->title)
                                            <a href="#"><li class="h3">{{$record->title}}</li></a>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h2>Данные отсутствуют</h2>
                @endif

            </div>
        </div>
    </div>
@endsection
