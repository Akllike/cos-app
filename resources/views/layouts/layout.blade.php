<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="Косметика для твоей жизни ❤">
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="Косметика для твоей жизни ❤" />
    <meta property="og:image" content="{{ url('storage/img/navbar.jpg') }}" />
    <meta property="og:url" content="{{ route('index') }}" />
    <meta name="yandex-verification" content="5d5fe7f3aca75c71" />

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    @yield('sidebar')
    @yield('header')
    @yield('content')
    @yield('modals')
    @yield('footer')
    <div id="cookie-notice" style="display:none; position: fixed; bottom: 0; background: white; width: 100%; padding: 10px; text-align: center; border-top: 1px solid black;">
        <h6>Мы используем файлы cookie!<br></h6><p>Используя наш сайт, вы соглашаетесь на использование файлов cookie. Нажимая "Принимаю", вы соглашаетесь на использование файлов cookie. Вы можете в любой момент изменить настройки файлов cookie в своем браузере.</p>
        <button class="btn btn-outline-dark border-2 add-cart" id="accept-cookies">Принимаю</button>
    </div>
</body>
<style>
    body {
        font-family: "Overpass", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
        font-style: normal;
    }

    .btn:focus {
        box-shadow: 0 0 0 0.2rem rgb(180, 155, 125, 0.5);
        border-color: rgba(180, 155, 125, 0.5);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgb(180, 155, 125, 0.5);
        border-color: rgba(180, 155, 125, 0.5);
    }

    .dropdown-item:active {
        color: var(--bs-dropdown-link-active-color);
        text-decoration: none;
        background-color: rgba(180, 155, 125, 0.5);
    }
</style>
</html>
