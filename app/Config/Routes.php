<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Controller
// Login
$routes->get('/login', 'AuthController::login');
$routes->post('/login/checkLogin', 'AuthController::checkLogin');
// Register
$routes->get('/register', 'AuthController::register');
$routes->post('/register/save', 'AuthController::save');
$routes->get('/registersuccess', 'AuthController::registerSuccess');
$routes->get('/verificationsuccess', 'AuthController::verificationSuccess');
$routes->get('/registerfailed', 'AuthController::registerFailed');
$routes->get('/verify-email/(:any)', 'AuthController::verifyEmail/$1');
// Logout
$routes->get('/logout', 'AuthController::logout');

########################################################################

 // User Controller
$routes->get('/', 'HomeController::home', ['filter' => 'roleFilter']);
$routes->get('/products', 'HomeController::products', ['filter' => 'roleFilter']);
$routes->get('/about', 'HomeController::aboutus', ['filter' => 'roleFilter']);
$routes->get('/blog', 'HomeController::blog', ['filter' => 'roleFilter']);
$routes->get('/shoppingcart', 'HomeController::shoppingCart', ['filter' => 'roleFilter']);
$routes->get('/account', 'HomeController::account', ['filter' => 'roleFilter']);

########################################################################

// Admin Controller
$routes->get('/admin/home', 'AdminController::home', ['filter' => 'roleFilter']);
$routes->get('/admin/orders', 'AdminController::orders', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/complete', 'AdminController::orderComplete', ['filter' => 'roleFilter']);
$routes->get('/admin/order/cancel', 'AdminController::orderCancel', ['filter' => 'roleFilter']);
$routes->get('/admin/products', 'AdminController::products', ['filter' => 'roleFilter']);
$routes->get('/admin/reports', 'AdminController::reports', ['filter' => 'roleFilter']);
$routes->get('/admin/customers', 'AdminController::customers', ['filter' => 'roleFilter']);
