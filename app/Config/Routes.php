<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth Controller
$routes->get('/login', 'AuthController::login');
 // Home Controller
$routes->get('/', 'HomeController::home');
$routes->get('/products', 'HomeController::products');
$routes->get('/about', 'HomeController::aboutus');
$routes->get('/blog', 'HomeController::blog');
$routes->get('/shoppingcart', 'HomeController::shoppingCart');
$routes->get('/account', 'HomeController::account');
// Admin Controller
$routes->get('/admin/home', 'AdminController::home');
$routes->get('/admin/orders', 'AdminController::orders');
$routes->get('/admin/orders/complete', 'AdminController::orderComplete');
$routes->get('/admin/order/cancel', 'AdminController::orderCancel');
$routes->get('/admin/products', 'AdminController::products');
$routes->get('/admin/reports', 'AdminController::reports');
