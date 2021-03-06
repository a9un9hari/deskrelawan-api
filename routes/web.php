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

// Auth
$router->get("/test", function(){
    return 'as';
});
$router->post("/register", "AuthController@register");
$router->post("/login", "AuthController@login");

$router->group(['middleware' => 'auth'], function () use ($router) {
    // User
    $router->get("/user", "UserController@index");

    // Kategori
    $router->get('/kategori', 'KategoriController@index');
    $router->get('/kategori/{id}', 'KategoriController@show');
    $router->post('/kategori', 'KategoriController@store');
    $router->put('/kategori/{id}', 'KategoriController@update');
    $router->delete('/kategori/{id}', 'KategoriController@destroy');

    // Aksi
    $router->get('/aksi', 'AksiController@index');
    $router->get('/aksi/{id}', 'AksiController@show');
    $router->post('/aksi', 'AksiController@store');
    $router->put('/aksi/{id}', 'AksiController@update');
    $router->delete('/aksi/{id}', 'AksiController@destroy');
});
