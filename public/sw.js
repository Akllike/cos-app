// Service Worker для ShaR с push-уведомлениями
const CACHE_NAME = 'shar-app-push-v1';
const OFFLINE_URL = '/offline';

const CORE_ASSETS = [
    '/',
    '/manifest.json'
];

self.addEventListener('install', event => {
    console.log('🎯 Service Worker: Установка...');

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => cache.addAll(CORE_ASSETS))
            .then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', event => {
    console.log('🔄 Service Worker: Активация');

    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// ==================== PUSH УВЕДОМЛЕНИЯ ====================

// Обработка полученных push-уведомлений

self.addEventListener('push', event => {
    console.log('📨 Push уведомление получено', event);

    let title = 'ShaR - Косметика во благо коже';
    let body = 'У вас новое уведомление!';
    let icon = '/storage/img/icon.png';
    let badge = '/storage/img/icon.png';
    let url = '/';
    let image = '/storage/img/wide-1.png';

    // Обработка данных уведомления
    if (event.data) {
        try {
            // Пробуем прочитать как JSON
            const data = event.data.json();
            console.log('📊 JSON данные:', data);

            title = data.title || title;
            body = data.body || body;
            icon = data.icon || icon;
            badge = data.badge || badge;
            url = data.url || url;
            image = data.image || image;

        } catch (jsonError) {
            // Если не JSON, читаем как текст
            try {
                const text = event.data.text();
                console.log('📝 Текстовые данные:', text);

                // Проверяем, это тест из DevTools или реальные данные
                if (text.includes('Тестирует') || text.includes('Test')) {
                    // Это тестовое уведомление из DevTools
                    title = 'ShaR - Тестовое уведомление 🎯';
                    body = 'Service Worker работает корректно! Push-уведомления активны.';
                } else {
                    // Другие текстовые данные
                    body = text;
                }
            } catch (textError) {
                console.log('❌ Не удалось прочитать данные:', textError);
                body = 'Новое уведомление от ShaR';
            }
        }
    } else {
        // Нет данных - тестовое уведомление
        console.log('🧪 Тестовое уведомление без данных');
        title = 'ShaR - Тест 🧪';
        body = 'Это тестовое push-уведомление! Service Worker работает.';
    }

    console.log('🎯 Показываем уведомление:', { title, body });

    const options = {
        body: body,
        icon: icon,
        badge: badge,
        image: image,
        data: {
            url: url,
            timestamp: Date.now()
        },
        vibrate: [100, 50, 100],
        actions: [
            {
                action: 'open',
                title: '📱 Открыть'
            },
            {
                action: 'close',
                title: '❌ Закрыть'
            }
        ],
        tag: 'shar-notification',
        requireInteraction: false,
        silent: false
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
            .then(() => {
                console.log('✅ Уведомление успешно показано');
            })
            .catch(error => {
                console.error('❌ Ошибка показа уведомления:', error);
            })
    );
});

// Обработка кликов по уведомлениям
self.addEventListener('notificationclick', event => {
    console.log('🖱 Клик по уведомлению:', event.action);

    event.notification.close();

    const urlToOpen = event.notification.data.url || '/';

    if (event.action === 'open' || !event.action) {
        // Открываем/фокусируем приложение
        event.waitUntil(
            clients.matchAll({
                type: 'window',
                includeUncontrolled: true
            }).then(windowClients => {
                // Ищем уже открытую вкладку
                for (let client of windowClients) {
                    if (client.url.includes(self.location.origin)) {
                        console.log('📍 Фокусируем существующую вкладку');
                        return client.focus();
                    }
                }

                // Открываем новую вкладку
                console.log('🆕 Открываем новую вкладку');
                return clients.openWindow(urlToOpen);
            })
        );
    }

    // Действие "close" - просто закрываем уведомление
    if (event.action === 'close') {
        console.log('❌ Уведомление закрыто пользователем');
    }
});

self.addEventListener('notificationclose', event => {
    console.log('📪 Уведомление закрыто', event.notification.tag);
});

// Фоновая синхронизация (для отложенных действий)
self.addEventListener('sync', event => {
    console.log('🔄 Фоновая синхронизация:', event.tag);

    if (event.tag === 'background-sync') {
        event.waitUntil(doBackgroundSync());
    }
});

async function doBackgroundSync() {
    // Здесь можно выполнить синхронизацию данных
    console.log('Выполняется фоновая синхронизация...');
}

// ==================== КЕШИРОВАНИЕ ====================

self.addEventListener('fetch', event => {
    const request = event.request;

    if (request.method !== 'GET') return;

    event.respondWith(
        fetch(request)
            .then(response => {
                if (response.status === 200) {
                    const responseClone = response.clone();
                    caches.open(CACHE_NAME)
                        .then(cache => cache.put(request, responseClone));
                }
                return response;
            })
            .catch(() => caches.match(request).then(cached =>
                cached || caches.match(OFFLINE_URL)
            ))
    );
});

console.log('🚀 Service Worker загружен');
