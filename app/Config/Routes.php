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
