<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::loginForm');
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::dashboard');
$routes->get('dashboarda', 'Dashboard::dashboard');

$routes->post('usuarios/ajax-add', 'Usuarios::createViaAjax');
$routes->post('usuarios/createViaAjax', 'Usuarios::createViaAjax2');
$routes->get('usuarios', 'Usuarios::usuarios');
$routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1');
$routes->get('usuarios/show/(:num)', 'Usuarios::show/$1');
$routes->put('usuarios/update/(:num)', 'Usuarios::updateUser/$1');


$routes->resource('usuarios');
//$routes->resource('motos');


$routes->get('motocicletas', 'Motocicletas::index');
$routes->post('motocicletas/createViaAjax', 'Motocicletas::createViaAjax');
// Para las funcionalidades futuras
$routes->get('motocicletas/details/(:num)', 'Motocicletas::details/$1');
$routes->put('motocicletas/update/(:num)', 'Motocicletas::update/$1');
$routes->delete('motocicletas/delete/(:num)', 'Motocicletas::delete/$1');

$routes->get('motocicletas/details/(:segment)', 'Motocicletas::getMotocicletaDetails/$1');
$routes->post('motocicletas/update/(:segment)', 'Motocicletas::update/$1');
$routes->delete('motocicletas/delete/(:segment)', 'Motocicletas::delete/$1');


// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->set404Override(function($message = null) {
    $response = service('response');
    $response->setStatusCode(404);
    return view('errors/html/error_404', ['message' => $message]);
});