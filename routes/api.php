<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
    route::post('register', 'RegisterController')->name('register');
    route::post('login', 'LoginController')->name('login');
    route::apiResource('/users', 'UserController');
});
