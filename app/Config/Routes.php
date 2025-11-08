<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
$routes->match(['get','post'], '/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->match(['get','post'], '/register', 'Auth::register');
$routes->match(['get','post'], '/forgot', 'Auth::forgot');
$routes->match(['get','post'], 'reset-password', 'Auth::reset');

$routes->get('/dashboard', 'Users::dashboard');

$routes->get('/admin', 'Admin::index');
$routes->get('/admin/view/(:num)', 'Admin::view/$1');
$routes->match(['get','post'], '/admin/edit/(:num)', 'Admin::edit/$1');
$routes->post('/admin/delete/(:num)', 'Admin::delete/$1');
$routes->get('/admin/export/excel', 'Admin::exportExcel');
$routes->get('/admin/export/pdf', 'Admin::exportPdf');