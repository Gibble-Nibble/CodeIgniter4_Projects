<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Pages::home');
$routes->get('/M1/home', 'Pages::home');
$routes->get('/M1/about', 'Pages::about');
$routes->get('/M1/home', 'Pages::home');
$routes->get('/M1/customers', 'Customers::index');
$routes->get('/M1/users', 'Users::index');
