<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description', 'Косметика во благо коже ❤')">
    <meta property="og:title" content="@yield('title')" />
    <meta property="og:description" content="@yield('meta_description', 'Косметика во благо коже ❤')" />
    <meta property="og:image" content="@yield('meta_image', url('storage/img/logo.png'))" />
    <meta property="og:url" content="@yield('meta_url', route('index'))" />
    <!-- VK.com -->
    <meta property="og:product:price:amount" content="@yield('meta_product_price')">
    <meta property="og:product:price:currency" content="@yield('meta_product_currency')">
    <meta property="vk:image" content="@yield('meta_product_image', url('storage/img/logo.png'))">

    <meta name="yandex-verification" content="5d5fe7f3aca75c71" />

    <link rel="canonical" href="@yield('link_canonical', url('/'))">

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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

    <div id="page-loader" class="page-loader">
        <div class="loader-content">
            <!-- <img src="{{ url('/storage/img/loader.gif') }}" alt="Loading" class="loader-gif"> -->
            <div class="loading-text">Загружаем <span class="heart">❤️</span></div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            setTimeout(() => {
                loader.classList.add('hidden');
                loader.addEventListener('transitionend', () => loader.remove());
            }, 1000);
        });
    </script>
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

    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.6s ease;
    }

    .loader-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .loader-gif {
        width: 100px; /* Настройте под ваш GIF */
        height: auto;
    }

    .loading-text {
        font-size: 18px;
        color: #333;
    }

    .heart {
        display: inline-block;
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }

    .page-loader.hidden {
        opacity: 0;
        pointer-events: none;
    }
</style>
</html>
