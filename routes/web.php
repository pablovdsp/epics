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

$router->group(['prefix' => 'api'], function () use ($router) {
    // Users
    $router->get('users', 'UserController@index');
    $router->post('users', 'UserController@store');
    $router->put('users/{id}', 'UserController@update');
    $router->get('users/{id}', 'UserController@show');
    $router->delete('users/{id}', 'UserController@destroy');

    // Logs
    $router->get('/logs', 'UserLogController@index');
    $router->get('/logs/{id}', 'UserLogController@show');
});