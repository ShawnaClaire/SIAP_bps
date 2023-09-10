<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Dashboard::index', ['filter'=>'loginFilter']);
$routes->get('/trydate', 'Dashboard::trydate', ['filter'=>'loginFilter']);
$routes->get('/trydate2', 'Dashboard::trydate2', ['filter'=>'loginFilter']);

$routes->get('/auth', 'Auth::index', ['filter'=>'authFilter']);
$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/kegiatan', 'Kegiatan::index', ['filter'=>'loginFilter']);
$routes->post('/kegiatan/save', 'Kegiatan::save', ['filter'=>'loginFilter']);

$routes->get('/mitra', 'Mitra::index', ['filter'=>'loginFilter']);
$routes->get('/mitra/export', 'Mitra::export', ['filter'=>'loginFilter']);
$routes->get('/mitra/tambahmitra', 'Mitra::tambahmitra', ['filter'=>'loginFilter']);
$routes->post('/mitra/import', 'Mitra::import', ['filter'=>'loginFilter']);
$routes->post('/mitra/tambahmanual', 'Mitra::tambahmanual', ['filter'=>'loginFilter']);

$routes->get('/mitra/alokasimitra', 'Mitra::alokasimitra', ['filter'=>'loginFilter']);
// $routes->get('/mitra/fetchKegiatan', 'Mitra::fetchKegiatan', ['filter'=>'loginFilter']);
$routes->post('/mitra/alokasiGetKegiatan', 'Mitra::alokasiGetKegiatan', ['filter'=>'loginFilter']);
$routes->post('/mitra/tambahalokasimanual', 'Mitra::tambahalokasimanual', ['filter'=>'loginFilter']);
$routes->post('/mitra/importAlokasi', 'Mitra::importAlokasi', ['filter'=>'loginFilter']);

$routes->post('/mitra/getAlokasiMitraAjax', 'Mitra::getAlokasiMitraAjax', ['filter'=>'loginFilter']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
