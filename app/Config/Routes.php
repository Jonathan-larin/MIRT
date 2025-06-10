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
$routes->resource('motos');



// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->set404Override(function() {
    return redirect()->to('/login');
});