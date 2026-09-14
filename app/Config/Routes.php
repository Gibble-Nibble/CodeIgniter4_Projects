<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::home');
$routes->get('/about', 'Pages::about');
$routes->get('/home', 'Pages::home');
$routes->get('/customers', 'Customers::index');
$routes->get('/users', 'Users::index');
