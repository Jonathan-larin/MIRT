<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->get('/', 'Login::index');                //Mostar formulario
$routes->post('/', 'Login::authenticate');        // Realizar la autenticacion

$routes->set404Override(function() {
    return redirect()->to('/');
});