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
    <div class="flex space-x-4 mb-4">
        <button id="pushToggle"
                onclick="window.pushManager.isSubscribed ? window.pushManager.unsubscribe() : window.pushManager.subscribe()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition">
            🔕 Включить уведомления
        </button>

        <button onclick="window.pushManager.testVAPID()"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
            🧪 Тест VAPID
        </button>

        <button onclick="window.pushManager.getStats()"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
            📊 Статистика
        </button>
    </div>
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

    {{-- Push Notifications --}}
    <script>
        class PushManager {
            constructor() {
                this.publicKey = null;
                this.isSubscribed = false;
            }

            // Функция конвертации ключа
            urlBase64ToUint8Array(base64String) {
                try {
                    const padding = '='.repeat((4 - base64String.length % 4) % 4);
                    const base64 = (base64String + padding)
                        .replace(/-/g, '+')
                        .replace(/_/g, '/');

                    const rawData = window.atob(base64);
                    const outputArray = new Uint8Array(rawData.length);

                    for (let i = 0; i < rawData.length; ++i) {
                        outputArray[i] = rawData.charCodeAt(i);
                    }
                    return outputArray;
                } catch (error) {
                    console.error('❌ Ошибка конвертации ключа:', error);
                    throw new Error('Неверный формат VAPID ключа');
                }
            }

            async init() {
                if (!this.isPushSupported()) {
                    console.log('❌ Push уведомления не поддерживаются');
                    return false;
                }

                try {
                    // Получаем public key
                    const response = await fetch('/push/vapid-public-key');
                    const data = await response.json();
                    this.publicKey = data.publicKey;

                    await this.checkSubscription();
                    console.log('✅ Push Manager инициализирован');
                    console.log('Public Key:', this.publicKey);
                    return true;
                } catch (error) {
                    console.error('❌ Ошибка инициализации:', error);
                    return false;
                }
            }

            isPushSupported() {
                return 'serviceWorker' in navigator &&
                    'PushManager' in window &&
                    'Notification' in window;
            }

            async checkSubscription() {
                const registration = await navigator.serviceWorker.ready;
                const subscription = await registration.pushManager.getSubscription();
                this.isSubscribed = !(subscription === null);
                this.updateUI();
                return this.isSubscribed;
            }

            async subscribe() {
                try {
                    console.log('🔔 Запрашиваем разрешение на уведомления...');
                    const permission = await Notification.requestPermission();

                    if (permission !== 'granted') {
                        throw new Error('Разрешение не получено');
                    }

                    console.log('✅ Разрешение получено');

                    const registration = await navigator.serviceWorker.ready;

                    // Проверяем VAPID ключ
                    if (!this.publicKey || this.publicKey.length < 10) {
                        throw new Error('VAPID ключ не настроен на сервере');
                    }

                    console.log('🔑 Используем VAPID key:', this.publicKey.substring(0, 20) + '...');

                    // Конвертируем ключ
                    const applicationServerKey = this.urlBase64ToUint8Array(this.publicKey);

                    console.log('📝 Создаем подписку с VAPID...');
                    const subscription = await registration.pushManager.subscribe({
                        userVisibleOnly: true,
                        applicationServerKey: applicationServerKey
                    });

                    console.log('✅ Подписка с VAPID создана:', subscription);

                    // Отправляем подписку на сервер
                    await this.sendSubscriptionToServer(subscription);

                    this.isSubscribed = true;
                    this.updateUI();

                    console.log('🎉 Push-уведомления активированы с VAPID');
                    this.showTestNotification('VAPID подключен! 🚀', 'Теперь вы будете получать уведомления даже когда сайт закрыт.');

                } catch (error) {
                    console.error('❌ Ошибка подписки:', error);

                    if (error.name === 'AbortError') {
                        this.showError('Браузер не поддерживает push-уведомления с VAPID.');
                    } else if (error.message.includes('VAPID')) {
                        this.showError('Проблема с VAPID ключами: ' + error.message);
                    } else {
                        this.showError('Ошибка: ' + error.message);
                    }
                }
            }

            async unsubscribe() {
                try {
                    const registration = await navigator.serviceWorker.ready;
                    const subscription = await registration.pushManager.getSubscription();

                    if (subscription) {
                        await subscription.unsubscribe();
                        this.isSubscribed = false;
                        this.updateUI();
                        console.log('❌ Подписка отменена');
                    }
                } catch (error) {
                    console.error('❌ Ошибка отмены подписки:', error);
                }
            }

            async sendSubscriptionToServer(subscription) {
                console.log('📤 Отправляем подписку на сервер...', subscription);

                const response = await fetch('/push/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(subscription)
                });

                const result = await response.json();
                console.log('📥 Ответ сервера:', result);
                return result;
            }

            updateUI() {
                const btn = document.getElementById('pushToggle');
                if (btn) {
                    btn.textContent = this.isSubscribed ?
                        '🔔 Уведомления включены' :
                        '🔕 Включить уведомления';
                    btn.className = this.isSubscribed ?
                        'bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition' :
                        'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded transition';
                }
            }

            showTestNotification(title, body) {
                if (Notification.permission === 'granted') {
                    navigator.serviceWorker.ready.then(registration => {
                        registration.showNotification(title, {
                            body,
                            icon: '/storage/img/icon.png'
                        });
                    });
                }
            }

            showError(message) {
                alert(message);
            }

            // Тестирование VAPID
            async testVAPID() {
                try {
                    const response = await fetch('/push/test');
                    const result = await response.json();
                    console.log('🧪 VAPID тест:', result);
                    alert(result.message + '\nVAPID настроен: ' + result.vapid_configured);
                } catch (error) {
                    console.error('❌ Ошибка VAPID теста:', error);
                    alert('Ошибка теста VAPID: ' + error.message);
                }
            },

            // Получение статистики
            async getStats() {
                try {
                    const response = await fetch('/push/stats');
                    const result = await response.json();
                    console.log('📊 Статистика:', result);
                    alert(`Подписчиков: ${result.total_subscriptions}\nVAPID: ${result.vapid_configured ? '✅' : '❌'}`);
                } catch (error) {
                    console.error('❌ Ошибка получения статистики:', error);
                    alert('Ошибка получения статистики. Проверьте маршрут /push/stats');
                }
            }
        }

        // Инициализация при загрузке
        document.addEventListener('DOMContentLoaded', async function() {
            window.pushManager = new PushManager();
            const pushSupported = await window.pushManager.init();

            if (pushSupported) {
                console.log('🚀 Push уведомления доступны');
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
