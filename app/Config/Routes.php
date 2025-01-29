<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Welcome');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('admin/(:any)', 'Home::index');


#$routes->resource('promocodes');
#$routes->resource('product');
#$routes->get('product', 'Product::index', ['filter' => 'authFilter']);
#$routes->post('product', 'Product::create', ['filter' => 'authFilter']);
#$routes->get('validateCard/(:segment)', 'Product::validateCard/$1', ['filter' => 'authFilter']);

$routes->group('api', function($router) {
    $router->post("register", "User::register", ['filter' => 'cors']);
    $router->post("login", "User::login", ['filter' => 'cors']);
    $router->get("profile", "User::details", ['filter' => 'authFilter', 'cors']);
  
    $router->get('users/(:any)', 'User::getUser/$1', ['filter' => 'authFilter', 'cors']);
    $router->get('db', 'Db::index');

    $router->get('product', 'Product::index', ['filter' => 'cors']);
    $router->post('product', 'Product::create', ['filter' => 'cors']);
    $router->get('validateCard/(:segment)', 'Product::validateCard/$1', ['filter' => 'cors']);

    $router->get('promocodes', 'Promocode::index', ['filter' => 'cors']);
	$router->get('get_promocode', 'Promocode::get_promocode', ['filter' => 'cors']);
    $router->post('promocodes', 'Promocode::create', ['filter' => 'cors']);
    $router->put('promocodes/(:segment)', 'Promocode::update/$1', ['filter' => 'cors']); #'authFilter', 
    $router->get('promocodes/(:segment)', 'Promocode::show/$1', ['filter' => 'cors']);

	$router->post('update_promocode/(:any)', 'Promocode::create/$1', ['filter' => 'cors']);

    $router->delete('promocodes/(:segment)', 'Promocode::delete/$1', ['filter' => 'cors']);
    
    $router->get('summary', 'Promocode::summary', ['filter' => 'cors'] );

    # Open API without security token for website
    $router->get('get_promocodes', 'Promocode::index', ['filter' => 'cors']);
    $router->get('product/(:any)', 'Product::show/$1', ['filter' => 'cors']);

    $router->post('makepayment', 'Payment::chargeCreditCard', ['filter' => 'cors']);

});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
