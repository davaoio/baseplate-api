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
        Route::post('check-username', 'AuthController@checkUsername')->name('auth.checkUsername');
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
        Route::get('me', 'AuthController@me')->name('auth.me');

        Route::post('register', 'RegisterController')->name('register');
        Route::post('forgot-password', 'ForgotPasswordController')->name('forgotPassword');
        Route::post('reset-password', 'ResetPasswordController')->name('resetPassword');
        Route::post('verification/verify', 'VerificationController@verify')->name('verification.verify');
        Route::post('verification/resend', 'VerificationController@resend')->name('verification.resend');
    });

    Route::post('users/{id}/avatar', 'UserAvatarController@store')->name('user.avatar.store');
    Route::delete('users/{id}/avatar', 'UserAvatarController@destroy')->name('user.avatar.destroy');
    Route::get('users/{id}/avatar', 'UserAvatarController@show')->name('user.avatar.show');
    Route::get('users/{id}/avatar/thumb', 'UserAvatarController@showThumb')->name('user.avatar.showThumb');
    Route::apiResource('/users', 'UserController');
});


Route::get('v1/test', function () {
    return response()->json([
        'data' => 'sample data',
    ]);
});
