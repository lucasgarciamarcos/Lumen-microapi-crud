<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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


// Users API
$router->group(['prefix' => 'users'], function ($router) {
    $router->post('/', 'UserController@list');
    $router->post('/create', 'UserController@create');
    $router->get('/get/{user_id}', 'UserController@get');
    $router->get('/delete/{user_id}', 'UserController@delete');
    $router->post('/update/{user_id}', 'UserController@update');
});

$router->get('/home', function ()  {
    return view('app');
});