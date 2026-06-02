const CACHE_NAME = 'loan-pocket-v4';
const ASSETS_TO_CACHE = [
  '/',
  '/assets/img/logo-192.png',
  '/assets/img/logo-512.png',
  '/public/css/output.css',
  // Add other assets you want cached here
];

self.addEventListener('install', event => {
  console.log('Service Worker Installed');
  self.skipWaiting();
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache =>
      Promise.allSettled(ASSETS_TO_CACHE.map(asset => cache.add(asset)))
    )
  );
});

self.addEventListener('activate', event => {
  console.log('Service Worker Activated');
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.filter(key => key !== CACHE_NAME)
            .map(key => caches.delete(key))
      )
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', event => {
  const { request } = event;

  // Never intercept non-GET requests to avoid Request method errors.
  if (request.method !== 'GET') {
    return;
  }

  const url = new URL(request.url);

  // Ignore non-http(s) requests (extensions, chrome-internal, etc).
  if (url.protocol !== 'http:' && url.protocol !== 'https:') {
    return;
  }

  // For page navigations: use network-first, then cache fallback.
  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .then(networkResponse => {
          const copy = networkResponse.clone();
          caches.open(CACHE_NAME).then(cache => cache.put(request, copy));
          return networkResponse;
        })
        .catch(() => caches.match(request).then(resp => resp || caches.match('/')))
    );
    return;
  }

  // For same-origin static assets: stale-while-revalidate.
  if (url.origin === self.location.origin) {
    event.respondWith(
      caches.match(request).then(cachedResponse => {
        const networkFetch = fetch(request)
          .then(networkResponse => {
            const copy = networkResponse.clone();
            caches.open(CACHE_NAME).then(cache => cache.put(request, copy));
            return networkResponse;
          })
          .catch(() => cachedResponse);

        return cachedResponse || networkFetch;
      })
    );
  }
});
