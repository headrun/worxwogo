var cacheName = 'worxogo';
var filesToCache = [
  '/',
  '/worxogo/dashboard/index',
  '/worxogo/dashboard/profile',
  '/worxogo/dashboard/leaderboard',
  
  '/worxogo/assets/js/jquery.js',
  '/worxogo/assets/js/bootstrap.min.js',
  '/worxogo/assets/js/dexie.js',
  '/worxogo/assets/js/app.js',
  '/worxogo/assets/js/profile.js',
  '/worxogo/assets/js/leaderboard.js',
  '/worxogo/assets/js/loader.js',
  
  '/worxogo/assets/css/inline.css',
  '/worxogo/assets/css/bootstrap.min.css',
  '/worxogo/assets/css/font-awesome.css',
  
  '/worxogo/assets/css/master.css',
  '/worxogo/assets/css/index.css',
  
  '/worxogo/assets/css/profile.css',
  
  '/worxogo/assets/spinners/mk-spinners.css',
  '/worxogo/assets/css/register.css',
  
  '/worxogo/assets/css/leaderboard.css',
  
  '/worxogo/assets/img/logo/44.jpg',
  '/worxogo/assets/favicon/favicon.ico',
  '/worxogo/images/icons/worxogo.png',
  
  '/worxogo/manifest.json',
  
  
];

self.addEventListener('install', function(e) {
  console.log('[ServiceWorker] Install.');

  if (self.skipWaiting) { self.skipWaiting(); }
    e.waitUntil(
        caches.open(cacheName).then(function(cache) {
            return Promise.all(filesToCache.map(function(url) {
                console.log('[ServiceWorker] Caching App Shell');
                return cache.add(url);
            }));
        })
    );
 
});

self.addEventListener('activate', function(event) {
  console.log('[ServiceWorker] Activate');

    var cacheWhitelist = [cacheName];

    event.waitUntil(
        caches.keys().then(function(cacheNames) {
            return Promise.all(
                cacheNames.map(function(cacheName) {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('[ServiceWorker] Removing old cache', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

self.addEventListener('fetch', function(event) {
var requestURL = new URL(event.request.url);

    event.respondWith(

        fetch(event.request).then(function(response) {
            if (response.status === 200) {
                caches.open(cacheName).then(function(cache) {
                    cache.put(event.request, response);
                });
            }
            return response.clone();
        }).catch(function(error) {
            return caches.open(cacheName)
                .then(function(cache) {

                    return cache.match(event.request)
                        .then(function(cachedResponse) {
                            if (cachedResponse) {
                                return cachedResponse;
                            } else {
                                return error
                            };
                        })
                })
        })
    )
});
