const CACHE_NAME = 'cos-app-vite-v1.0';
const STATIC_CACHE = 'static-vite-v1';
const DYNAMIC_CACHE = 'dynamic-vite-v1';

// Базовые ресурсы которые не меняются
const staticAssets = [
    '/',
    '/offline',
    '/manifest.json',
    // Иконки
    '/storage/img/icon.png',
    '/storage/img/icon72.png',
    '/storage/img/icon96.png',
    '/storage/img/icon128.png',
    '/storage/img/icon144.png',
    '/storage/img/icon192.png',
    '/storage/img/icon384.png',
    '/storage/img/wide-1.png',
    '/storage/img/narrow-1.jpg'
];

// Установка Service Worker
self.addEventListener('install', event => {
    console.log('Service Worker: Installing...');
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => {
                console.log('Caching static assets');
                return cache.addAll(staticAssets);
            })
            .then(() => self.skipWaiting())
    );
});

// Активация
self.addEventListener('activate', event => {
    console.log('Service Worker: Activated');
    event.waitUntil(
        caches.keys().then(keys => {
            return Promise.all(
                keys.map(key => {
                    if (key !== STATIC_CACHE && key !== DYNAMIC_CACHE) {
                        console.log('Removing old cache:', key);
                        return caches.delete(key);
                    }
                })
            );
        })
    );
    return self.clients.claim();
});

// Стратегия кеширования для Vite
self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    // Пропускаем не-GET запросы и Vite HMR в разработке
    if (event.request.method !== 'GET' ||
        url.pathname.includes('@vite') ||
        url.hostname === 'localhost' && url.port !== '') {
        return;
    }

    // Для Vite ресурсов используем сеть сначала, потом кеш
    if (url.pathname.includes('/assets/') ||
        event.request.destination === 'script' ||
        event.request.destination === 'style') {

        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Кешируем только успешные ответы
                    if (response.status === 200) {
                        const responseToCache = response.clone();
                        caches.open(DYNAMIC_CACHE)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });
                    }
                    return response;
                })
                .catch(() => {
                    // Если сеть недоступна, используем кеш
                    return caches.match(event.request);
                })
        );

    } else {
        // Для HTML и других ресурсов - кеш сначала
        event.respondWith(
            caches.match(event.request)
                .then(cachedResponse => {
                    if (cachedResponse) {
                        return cachedResponse;
                    }

                    return fetch(event.request)
                        .then(fetchResponse => {
                            if (!fetchResponse || fetchResponse.status !== 200) {
                                return fetchResponse;
                            }

                            const responseToCache = fetchResponse.clone();
                            caches.open(DYNAMIC_CACHE)
                                .then(cache => {
                                    cache.put(event.request, responseToCache);
                                });

                            return fetchResponse;
                        })
                        .catch(error => {
                            if (event.request.destination === 'document') {
                                return caches.match('/offline');
                            }
                            return new Response('Нет соединения', {
                                status: 503,
                                statusText: 'Service Unavailable'
                            });
                        });
                })
        );
    }
});
