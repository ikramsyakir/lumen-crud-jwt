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

// API route group
$router->group(['prefix' => 'api'], function () use ($router) {

    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    $router->get('profile', 'UserController@profile');
    $router->get('users/{id}', 'UserController@singleUser');
    $router->get('users', 'UserController@allUsers');

    $router->get('/listing/{id}', 'ListingController@index');
    $router->post('/listing/create', 'ListingController@store');
    $router->get('/listing/show/{id}', 'ListingController@show');
    $router->put('/listing/update/{id}', 'ListingController@update');
    $router->delete('/listing/delete/{id}', 'ListingController@destroy');

});
