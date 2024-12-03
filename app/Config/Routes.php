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
$routes->get('/admin/flash_info/new_product', 'AdminController::newProductInfo', ['filter' => 'roleFilter']);
$routes->get('/admin/flash_info/stock', 'AdminController::stockInfo', ['filter' => 'roleFilter']);
$routes->get('/admin/flash_info/new_event', 'AdminController::newEventInfo', ['filter' => 'roleFilter']);
$routes->get('/admin/flash_info/new_user', 'AdminController::newUser', ['filter' => 'roleFilter']);

$routes->get('/admin/orders/list', 'AdminController::orders', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/complete', 'AdminController::orderComplete', ['filter' => 'roleFilter']);
$routes->get('/admin/orders/cancel', 'AdminController::orderCancel', ['filter' => 'roleFilter']);

$routes->get('/admin/products', 'AdminController::products', ['filter' => 'roleFilter']);
$routes->get('/admin/product_lists', 'AdminController::productLists', ['filter' => 'roleFilter']);
$routes->get('/admin/product/detail/(:any)', 'AdminController::detailProduct/$1', ['filter' => 'roleFilter']);
$routes->get('/admin/products/add', 'AdminController::addProduct', ['filter' => 'roleFilter']);
$routes->post('/admin/products/save', 'AdminController::saveProduct', ['filter' => 'roleFilter']);
$routes->get('/admin/products/delete/(:any)', 'AdminController::deleteProduct/$1', ['filter' => 'roleFilter']);
$routes->get('/admin/products/edit/(:any)', 'AdminController::editProduct/$1', ['filter' => 'roleFilter']);
$routes->get('/admin/products/search', 'AdminController::search', ['filter' => 'roleFilter']);

$routes->get('/admin/reports', 'AdminController::reports', ['filter' => 'roleFilter']);
$routes->get('/admin/customers', 'AdminController::customers', ['filter' => 'roleFilter']);
$routes->get('/admin/discount_event', 'AdminController::discountEvent', ['filter' => 'roleFilter']);
$routes->get('/admin/add_discount_event', 'AdminController::addDiscountEvent', ['filter' => 'roleFilter']);
$routes->post('/admin/add_discount_event/save', 'AdminController::saveDiscountEvent', ['filter' => 'roleFilter']);
$routes->get('/admin/discount_event/detail/(:any)', 'AdminController::detailDiscountEvent/$1', ['filter' => 'roleFilter']);
$routes->get('/admin/discount', 'AdminController::discount', ['filter' => 'roleFilter']);
$routes->get('/admin/review', 'AdminController::review', ['filter' => 'roleFilter']);
$routes->post('/upload-image', 'ImageController::upload', ['filter' => 'roleFilter']);

