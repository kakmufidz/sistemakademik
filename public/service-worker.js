const CACHE_NAME = 'my-cache-v1';
const urlsToCache = [
  '/',
  '/manifest.json',
//   '/css/styles.css', // Sesuaikan dengan file CSS kamu
//   '/js/scripts.js',  // Sesuaikan dengan file JS kamu
  // Tambahkan file lain yang perlu dicache
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
