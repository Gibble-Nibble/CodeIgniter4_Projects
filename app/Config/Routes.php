<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::home');

// Module 1 routes
$routes->get('/M1/index', 'Pages::module1_index');
$routes->get('/M1/about', 'Pages::module1_about');
$routes->get('/M1/customers', 'Customers::index');
$routes->get('/M1/users', 'Users::index');

// Module 2 routes
$routes->get('/M2/index', 'Pages::module2_index');
$routes->get('/M2/about', 'Pages::module2_about');
$routes->get('/M2/customers', 'Customers::module2_index');
$routes->get('/M2/users', 'Users::module2_index');

// TSA1 routes
$routes->get('/TSA1/index', 'TSA1\Tasks::welcome');
$routes->get('/TSA1/about', 'TSA1\Tasks::about');
$routes->get('/TSA1/tasks', 'TSA1\Tasks::index');
$routes->get('/TSA1/profile', 'TSA1\Tasks::profile');

// TSA2 routes
$routes->get('/TSA2/index', 'TSA2\Tasks::welcome');
$routes->get('/TSA2/about', 'TSA2\Tasks::about');
$routes->get('/TSA2/tasks', 'TSA2\Tasks::index');
$routes->get('/TSA2/profile', 'TSA2\Tasks::profile');
$routes->match(['get', 'post'], '/TSA2/login', 'TSA2\Auth::login');
$routes->get('/TSA2/logout', 'TSA2\Auth::logout');
$routes->get('/TSA2/tasks/new', 'TSA2\Tasks::new');
$routes->post('/TSA2/tasks', 'TSA2\Tasks::create');
$routes->get('/TSA2/tasks/(:num)/edit', 'TSA2\Tasks::edit/$1');
$routes->post('/TSA2/tasks/(:num)', 'TSA2\Tasks::update/$1');
$routes->post('/TSA2/tasks/(:num)/delete', 'TSA2\Tasks::delete/$1');
