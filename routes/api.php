<?php

use Illuminate\Http\Request;

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
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');

        Route::post('register', 'RegisterController')->name('register');
    });

    Route::post('users/{id}/avatar', 'UserAvatarController@store')->name('user.avatar.store');
    Route::delete('users/{id}/avatar', 'UserAvatarController@destroy')->name('user.avatar.destroy');
    Route::get('users/{id}/avatar', 'UserAvatarController@show')->name('user.avatar.show');
    Route::get('users/{id}/avatar/thumb', 'UserAvatarController@showThumb')->name('user.avatar.showThumb');
    Route::apiResource('/users', 'UserController');
});

