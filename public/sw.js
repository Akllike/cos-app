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

    let data = {
        title: 'ShaR - Косметика во благо коже',
        body: 'У вас новое уведомление!',
        icon: '/storage/img/icon.png',
        badge: '/storage/img/icon.png',
        url: '/'
    };

    try {
        if (event.data) {
            data = { ...data, ...event.data.json() };
        }
    } catch (error) {
        console.log('Ошибка парсинга данных:', error);
    }

    const options = {
        body: data.body,
        icon: data.icon,
        badge: data.badge,
        data: {
            url: data.url
        },
        vibrate: [200, 100, 200],
        actions: [
            {
                action: 'open',
                title: 'Открыть'
            },
            {
                action: 'close',
                title: 'Закрыть'
            }
        ]
    };

    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

self.addEventListener('notificationclick', event => {
    console.log('🖱 Клик по уведомлению', event);

    event.notification.close();

    const urlToOpen = event.notification.data.url || '/';

    event.waitUntil(
        clients.matchAll({
            type: 'window',
            includeUncontrolled: true
        }).then(windowClients => {
            for (let client of windowClients) {
                if (client.url.includes(self.location.origin) && 'focus' in client) {
                    return client.focus();
                }
            }

            if (clients.openWindow) {
                return clients.openWindow(urlToOpen);
            }
        })
    );
});

// Обработка действий в уведомлениях
self.addEventListener('notificationclose', event => {
    console.log('❌ Уведомление закрыто', event);
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
