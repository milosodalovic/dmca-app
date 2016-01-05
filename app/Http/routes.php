<?php

/*
 * The routing for the application
*/

/*
 * Authentication
 */
//Route::controllers([
//    'auth'      => 'Auth\AuthController',
//    'password'  => 'Auth\PasswordController'
//]);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
//    Route::auth();
    Route::get('/', 'PagesController@home');
    Route::controllers([
        'auth'      => 'Auth\AuthController',
        'password'  => 'Auth\PasswordController'
    ]);

});

