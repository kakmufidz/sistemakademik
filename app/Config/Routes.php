<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('webhook/absensi', 'Webhook::absensi');

$routes->get('/docview/(:any)/(:any)', 'Dokumen::docview/$1/$2/$3');
$routes->get('/docload/(:any)/(:any)', 'Dokumen::docload/$1/$2/$3');

$routes->setAutoRoute(true); // Hati-hati dengan AutoRoute (potensi security risk)