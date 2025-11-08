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

    {{-- PWA функциональность --}}
    <script>
        // Регистрация Service Worker
        if ('serviceWorker' in navigator) {
            // В разработке не регистрируем SW для избежания конфликтов с Vite HMR
            const isLocalhost = window.location.hostname === 'localhost' ||
                window.location.hostname === '127.0.0.1';

            if (!isLocalhost) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js')
                        .then(function(registration) {
                            console.log('ServiceWorker зарегистрирован успешно: ', registration.scope);
                        })
                        .catch(function(error) {
                            console.log('Ошибка регистрации ServiceWorker: ', error);
                        });
                });
            }
        }

        // Функциональность установки PWA
        let deferredPrompt;
        const installButton = document.getElementById('installButton');

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;

            if (installButton) {
                installButton.style.display = 'block';

                installButton.addEventListener('click', async () => {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        const { outcome } = await deferredPrompt.userChoice;
                        console.log(`Пользователь ${outcome} установку`);
                        deferredPrompt = null;
                        installButton.style.display = 'none';
                    }
                });
            }
        });

        window.addEventListener('appinstalled', () => {
            console.log('PWA успешно установлено');
            if (installButton) {
                installButton.style.display = 'none';
            }
            deferredPrompt = null;
        });

        // Показать кнопку установки если приложение не установлено
        window.addEventListener('load', () => {
            if (window.matchMedia('(display-mode: standalone)').matches ||
                window.navigator.standalone === true) {
                // Приложение уже установлено
                if (installButton) installButton.style.display = 'none';
            }
        });
    </script>

    {{-- Кнопка установки PWA --}}
    @if(!request()->is('login') && !request()->is('register'))
        <button id="installButton"
                style="display: none;"
                class="fixed bottom-4 right-4 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition-colors z-50"
                title="Установить приложение">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </button>
    @endif
</body>
</html>
