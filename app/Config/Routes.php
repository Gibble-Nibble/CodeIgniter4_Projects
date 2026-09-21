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
$routes->get('/', 'TSA1\Tasks::welcome');
$routes->get('/tasks', 'TSA1\Tasks::index');
$routes->get('/profile', 'TSA1\Tasks::profile');
$routes->get('/about', 'TSA1\Tasks::about');
