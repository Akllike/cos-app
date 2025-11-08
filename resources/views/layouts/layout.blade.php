<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    {{-- PWA Meta Tags --}}
    <meta name="theme-color" content="#6366f1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Cos App">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/icons/icon-192x192.png') }}">

    {{-- Для iOS Safari --}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

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

    {{-- PWA Service Worker Registration --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ('serviceWorker' in navigator) {
                console.log('🔍 Регистрируем Service Worker...');

                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('✅ Service Worker зарегистрирован:', registration);
                        console.log('Scope:', registration.scope);

                        // Проверяем статус
                        if (registration.installing) {
                            console.log('Status: installing');
                        } else if (registration.waiting) {
                            console.log('Status: waiting');
                        } else if (registration.active) {
                            console.log('Status: active');
                        }
                    })
                    .catch(function(error) {
                        console.error('❌ Ошибка регистрации:', error);
                    });

                // Прослушиваем изменения
                navigator.serviceWorker.addEventListener('controllerchange', function() {
                    console.log('🔄 Controller changed');
                });
            } else {
                console.log('❌ Service Worker не поддерживается');
            }
        });
    </script>

    {{-- Проверка PWA функциональности --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Проверка возможности установки
            let deferredPrompt;

            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                console.log('✅ PWA можно установить');

                // Показываем кнопку установки
                const installBtn = document.getElementById('installButton');
                if (installBtn) {
                    installBtn.style.display = 'block';
                    installBtn.onclick = () => {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.then((choiceResult) => {
                            console.log('Пользователь выбрал:', choiceResult.outcome);
                            deferredPrompt = null;
                            installBtn.style.display = 'none';
                        });
                    };
                }
            });

            // Проверка если уже установлено
            window.addEventListener('appinstalled', (evt) => {
                console.log('🎉 PWA установлено!');
            });

            // Проверка display mode
            if (window.matchMedia('(display-mode: standalone)').matches) {
                console.log('📱 Запущено как PWA');
            }
        });
    </script>

    {{-- Кнопка установки PWA --}}
    <button id="installButton"
            style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;"
            class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-indigo-700">
        📲 Установить приложение
    </button>
</body>
</html>
