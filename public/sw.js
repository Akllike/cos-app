const CACHE_NAME = 'shar-app-minimal-v1';

console.log('🛠 Service Worker: Загружен');

self.addEventListener('install', event => {
    console.log('✅ Service Worker: Установлен');
    // НИКАКОГО кеширования при установке - только активация
    event.waitUntil(self.skipWaiting());
});

self.addEventListener('activate', event => {
    console.log('✅ Service Worker: Активирован');
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
    // Пока просто пропускаем все запросы
    // Позже добавим кеширование
    return fetch(event.request);
});
