<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/key', function() {
    return str_random(32);
});

// =========================================
// USER API
// Without param id
$router->get('/user','UserController@index');
$router->get('/user/combo','UserController@combo'); // API Example to getting data for combobox
$router->post('/user','UserController@save');

// With param id
$router->get('/user/{id}','UserController@show');
$router->put('/user/{id}','UserController@update');
$router->put('/user/block/{id}','UserController@block');
$router->put('/user/unblock/{id}','UserController@unblock');
$router->put('/user/change-password/{id}','UserController@changePassword');
$router->delete('/user/{id}','UserController@destroy');
// =========================================

// =========================================
// Client API
// Without param id
$router->get('/client','ClientController@index');
$router->get('/client/combo','ClientController@combo');
$router->post('/client','ClientController@save');
// =========================================
