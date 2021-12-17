<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title_name')</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo"><a href="{{route('index_page')}}">CodeLearn</a></div>
            <nav>
                <a href="">HTML</a>
                <a href="">CSS</a>
                <a href="">Типографика</a>
                <a href="">Новости</a>
                <a href="">Верстка</a>
            </nav>
            <div class="auch">
                <a href="{{route('authorization_page')}}">Вход</a>
                <a href="{{route('register_page')}}">Регистрация</a>
            </div>
        </div>
    </header>
    <div class="message">{{ $errors->message->first() }}</div>
    <main>
        @yield('main')
    </main>

    <footer>
        <div class="container">
            <p>Иван Размыслов 2021</p>
            <p>Сайт был создан для проверки моих умений, и не собирается исп для получений какого либо заработка</p>
        </div>
    </footer>

{{--Подключение скриптов--}}
    @yield('script')
{{--    <script>--}}
{{--        let date = new Date();--}}
{{--        document.querySelector('footer div.container p').innerHTML = `Иван Размыслов 2021-${date.getFullYear()}`--}}
{{--    </script>--}}
</body>
</html>
