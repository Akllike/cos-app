// Безопасный Service Worker с диагностикой
const CACHE_NAME = 'shar-app-v1.1';

// Только проверенные рабочие URL
const safeUrlsToCache = [
    '/',
    '/manifest.json'
    // Картинки и другие ресурсы добавим ПОСЛЕ проверки
];

self.addEventListener('install', event => {
    console.log('🛠 Service Worker: Установка началась');

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('📦 Кешируем безопасные ресурсы...');

                // Кешируем только гарантированно рабочие URL
                return cache.addAll(safeUrlsToCache)
                    .then(() => {
                        console.log('✅ Базовые ресурсы успешно закешированы');
                    })
                    .catch(error => {
                        console.warn('⚠️ Частичная ошибка кеширования:', error);
                        // Продолжаем работу даже при ошибках
                    });
            })
            .then(() => {
                console.log('🚀 Пропускаем ожидание и активируем');
                return self.skipWaiting();
            })
    );
});

self.addEventListener('activate', event => {
    console.log('✅ Service Worker: Активирован');

    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('🗑 Удаляем старый кеш:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            console.log('🎯 Активация завершена, берем контроль');
            return self.clients.claim();
        })
    );
});

// Базовая стратегия кеширования - Network First
self.addEventListener('fetch', event => {
    // Для API запросов и динамического контента - всегда сеть
    if (event.request.url.includes('/api/') ||
        event.request.method !== 'GET') {
        return fetch(event.request);
    }

    event.respondWith(
        fetch(event.request)
            .then(response => {
                // Если запрос успешен - клонируем и кешируем
                if (response.status === 200) {
                    const responseClone = response.clone();
                    caches.open(CACHE_NAME)
                        .then(cache => {
                            cache.put(event.request, responseClone);
                        });
                }
                return response;
            })
            .catch(error => {
                // Если сеть недоступна - пробуем кеш
                console.log('📡 Сеть недоступна, пробуем кеш:', event.request.url);
                return caches.match(event.request)
                    .then(cachedResponse => {
                        if (cachedResponse) {
                            return cachedResponse;
                        }
                        // Можно вернуть offline страницу
                        return new Response('Оффлайн режим', {
                            status: 503,
                            statusText: 'Service Unavailable'
                        });
                    });
            })
    );
});

console.log('🛠 Service Worker v1.1 загружен');
