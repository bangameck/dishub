<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//index
$routes->get('/', 'Login::index');
//user
$routes->get('/user/add', 'User::add');
$routes->get('/user/edit/(:segment)', 'User::edit/$1');
$routes->delete('/user/(:num)', 'User::hapus/$1');
$routes->get('/user/(:any)', 'User::detail/$1');
//user_bidang_bagian
$routes->get('/bb_u/add', 'Bb_u::add');
$routes->get('/bb_u/get_bagian', 'Bb_u::get_bagian');
$routes->get('/bb_u/edit/(:segment)', 'Bb_u::edit/$1');
$routes->delete('/bb_u/(:num)', 'Bb_u::hapus/$1');
$routes->get('/bb_u/(:any)', 'Bb_u::detail');
//bidang
$routes->get('/bidang/add', 'Bidang::add');
$routes->get('/bidang/edit/(:segment)', 'Bidang::edit/$1');
$routes->delete('/bidang/(:num)', 'Bidang::hapus/$1');
$routes->get('/bidang/(:any)', 'Bidang::detail/$1');
//bidang
$routes->get('/bagian/add', 'Bagian::add');
$routes->get('/bagian/edit/(:segment)', 'Bagian::edit/$1');
$routes->delete('/bagian/(:num)', 'Bagian::hapus/$1');
$routes->get('/bagian/(:any)', 'Bagian::detail/$1');
//logout
$routes->get('/out', 'Login::out');


/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
