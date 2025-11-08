// Безопасный Service Worker с кешированием
const CACHE_NAME = 'shar-app-safe-v1';

// Только гарантированно рабочие URL
const safeUrlsToCache = [
    '/',
    '/manifest.json'
    // НЕ добавляем картинки и другие ресурсы пока
];

self.addEventListener('install', event => {
    console.log('🛠 Service Worker: Установка');

    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('📦 Пробуем кешировать безопасные ресурсы...');

                // Кешируем только гарантированно рабочие URL
                return cache.addAll(safeUrlsToCache)
                    .then(() => {
                        console.log('✅ Безопасные ресурсы закешированы');
                    })
                    .catch(error => {
                        console.log('⚠️ Ошибка кеширования, но продолжаем:', error);
                        // Продолжаем даже при ошибке
                    });
            })
            .then(() => {
                console.log('🚀 Активируем Service Worker');
                return self.skipWaiting();
            })
    );
});

self.addEventListener('activate', event => {
    console.log('✅ Service Worker: Активирован');
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
    // Для начала просто пропускаем все запросы
    return fetch(event.request);
});
