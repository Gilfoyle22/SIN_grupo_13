<?php
require_once './core/Router.php';

$router = new Router();

$router->get('/', 'HomeController@index');
$router->post('/', 'HomeController@local');
$router->get('/cart', 'CartController@index');
$router->get('/cart/add/{id}', 'CartController@store');
$router->post('/cart/update', 'CartController@update');
$router->post('/cart/remove', 'CartController@remove');
$router->get('/cart/clear', 'CartController@clear');

$router->get('/checkout', 'HomeController@checkout');


$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

$router->get('/history', 'HomeController@history');

//Admin

$router->get('/products', 'ProductController@index');
$router->get('/products/create', 'ProductController@create');
$router->post('/products/create', 'ProductController@store');
$router->post('/product/{id}/destroy', 'ProductController@destroy');
$router->get('/product/{id}', 'ProductController@edit');
$router->post('/product/{id}', 'ProductController@update');

$router->get('/locales', 'LocalController@index');
$router->get('/locales/create', 'LocalController@create');
$router->post('/locales/create', 'LocalController@store');
$router->post('/local/{id}/destroy', 'LocalController@destroy');
$router->get('/local/{id}', 'LocalController@edit');
$router->post('/local/{id}', 'LocalController@update');

$router->get('/orders', 'OrderController@index');
$router->get('/order/{id}/annul', 'OrderController@annul');
$router->get('/order/{id}', 'OrderController@show');



$router->set404('HomeController@error');
$router->run();