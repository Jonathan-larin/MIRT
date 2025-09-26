<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */

//Rutas de login y autenticacion

$routes->get('/', 'Auth::loginForm');
$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

//Redireccion a dashboard

$routes->get('dashboard', 'Dashboard::dashboard');
$routes->get('dashboarda', 'Dashboard::dashboard');

// Ruta para el registro de actividad
$routes->get('activity-log', 'Dashboard::activityLog');
$routes->get('activity-log/export-csv', 'Dashboard::exportActivityLogCsv');

// Ruta para el perfil de usuario
$routes->get('profile', 'Profile::index');
$routes->get('profile/edit', 'Profile::edit');
$routes->post('profile/update', 'Profile::update');
$routes->post('profile/change-password', 'Profile::changePassword');

// Rutas para la gestión de servicios
$routes->get('servicios', 'Servicios::index');
$routes->post('servicios/createViaAjax', 'Servicios::createViaAjax');
$routes->get('servicios/details/(:num)', 'Servicios::details/$1');
$routes->match(['POST', 'PUT'], 'servicios/update/(:num)', 'Servicios::update/$1');
$routes->delete('servicios/delete/(:num)', 'Servicios::delete/$1');
$routes->get('servicios/get-motocicletas', 'Servicios::getMotocicletas');
$routes->get('servicios/upcoming-count', 'Servicios::getUpcomingServicesCount');
$routes->get('servicios/upcoming-services', 'Servicios::getUpcomingServices');

// Rutas para la gestión de rentas
$routes->get('rentas', 'Rentas::index');
$routes->post('rentas/createRental', 'Rentas::createRental');
$routes->get('rentas/details/(:segment)', 'Rentas::getRentalDetails/$1');
$routes->post('rentas/update/(:segment)', 'Rentas::updateRental/$1');
$routes->post('rentas/end/(:segment)', 'Rentas::endRental/$1');
$routes->get('rentas/available-motorcycles', 'Rentas::getAvailableMotorcycles');
$routes->get('rentas/clients', 'Rentas::getClients');
$routes->get('rentas/expiring-count', 'Rentas::getExpiringLeasesCount');
$routes->get('rentas/expiring-leases', 'Rentas::getExpiringLeases');

// Rutas para la gestión de reportes
$routes->get('reportes', 'Reportes::index');
$routes->get('reportes/available-motorcycles', 'Reportes::generateAvailableMotorcyclesReport');
$routes->get('reportes/leased-motorcycles', 'Reportes::generateLeasedMotorcyclesReport');
$routes->get('reportes/active-services', 'Reportes::generateActiveServicesReport');
$routes->get('reportes/historical-services', 'Reportes::generateHistoricalServicesReport');
$routes->get('reportes/system', 'Reportes::generateSystemReport');

// Rutas para la gestión de usuarios

$routes->post('usuarios/ajax-add', 'Usuarios::createViaAjax');
$routes->post('usuarios/createViaAjax', 'Usuarios::createViaAjax2');
$routes->get('usuarios', 'Usuarios::usuarios');
$routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1');
$routes->get('usuarios/show/(:num)', 'Usuarios::show/$1');
$routes->put('usuarios/update/(:num)', 'Usuarios::updateUser/$1');

// Rutas para la gestión de clientes
$routes->get('clientes', 'Clientes::index');
$routes->post('clientes/create', 'Clientes::create');
$routes->get('clientes/list', 'Clientes::getClients');
$routes->get('clientes/getClient/(:num)', 'Clientes::getClient/$1');
$routes->put('clientes/update/(:num)', 'Clientes::update/$1');
$routes->delete('clientes/delete/(:num)', 'Clientes::delete/$1');

// Rutas para la gestión de empresas
$routes->get('empresas', 'Empresas::index');
$routes->post('empresas/create', 'Empresas::create');
$routes->get('empresas/list', 'Empresas::getCompanies');
$routes->get('empresas/getCompany/(:num)', 'Empresas::getCompany/$1');
$routes->put('empresas/update/(:num)', 'Empresas::update/$1');
$routes->delete('empresas/delete/(:num)', 'Empresas::delete/$1');

$routes->resource('usuarios');
//$routes->resource('motos');


//Rutas para la gestión de motocicletas

$routes->get('motocicletas', 'Motocicletas::index');
$routes->post('motocicletas/createViaAjax', 'Motocicletas::createViaAjax');
$routes->get('motocicletas/details/(:num)', 'Motocicletas::details/$1');
$routes->put('motocicletas/update/(:num)', 'Motocicletas::update/$1');
$routes->delete('motocicletas/delete/(:num)', 'Motocicletas::delete/$1');

$routes->get('motocicletas/details/(:segment)', 'Motocicletas::getMotocicletaDetails/$1');
$routes->get('motocicletas/services/(:segment)', 'Motocicletas::getServicesForMotorcycle/$1');
$routes->post('motocicletas/update/(:segment)', 'Motocicletas::update/$1');
$routes->delete('motocicletas/delete/(:segment)', 'Motocicletas::delete/$1');

//Aplicar filtro de autenticación a las rutas de dashboard

// $routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->set404Override(function($message = null) {
    $response = service('response');
    $response->setStatusCode(404);
    return view('errors/html/error_404', ['message' => $message]);
});
