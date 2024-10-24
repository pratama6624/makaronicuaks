<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Controller
// Login
$routes->get('/login', 'AuthController::login', ['filter' => 'loggedInFilter']);
$routes->post('/login/checkLogin', 'AuthController::checkLogin', ['filter' => 'loggedInFilter']);
// Register
$routes->get('/register', 'AuthController::register', ['filter' => 'loggedInFilter']);
$routes->post('/register/save', 'AuthController::save', ['filter' => 'loggedInFilter']);
$routes->get('/registersuccess', 'AuthController::registerSuccess', ['filter' => 'loggedInFilter']);
$routes->get('/verificationsuccess', 'AuthController::verificationSuccess', ['filter' => 'loggedInFilter']);
$routes->get('/registerfailed', 'AuthController::registerFailed', ['filter' => 'loggedInFilter']);
$routes->get('/verify-email/(:any)', 'AuthController::verifyEmail/$1', ['filter' => 'loggedInFilter']);
// Account Recovery
$routes->get('/accountrecovery', 'AuthController::accountRecovery', ['filter' => 'loggedInFilter']);
$routes->post('/recovery', 'AuthController::recovery', ['filter' => 'loggedInFilter']);
// Logout
$routes->get('/logout', 'AuthController::logout');

########################################################################

 // User Controller
$routes->get('/', 'HomeController::home');
$routes->get('/products', 'HomeController::products');
$routes->get('/about', 'HomeController::aboutus');
$routes->get('/blog', 'HomeController::blog');
$routes->get('/shoppingcart', 'HomeController::shoppingCart', ['filter' => 'roleFilter']);
$routes->get('/account', 'HomeController::account', ['filter' => 'roleFilter']);

########################################################################

// Admin Controller
$routes->get('/admin/home', 'AdminController::home', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/list', 'AdminController::orders', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/complete', 'AdminController::orderComplete', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/cancel', 'AdminController::orderCancel', ['filter' => 'roleFilter']);
$routes->get('/admin/products', 'AdminController::products', ['filter' => 'roleFilter']);
$routes->get('/admin/products/add', 'AdminController::addProduct', ['filter' => 'roleFilter']);
$routes->get('/admin/reports', 'AdminController::reports', ['filter' => 'roleFilter']);
$routes->get('/admin/customers', 'AdminController::customers', ['filter' => 'roleFilter']);
$routes->get('/admin/discount', 'AdminController::discount', ['filter' => 'roleFilter']);
$routes->get('/admin/review', 'AdminController::review', ['filter' => 'roleFilter']);
