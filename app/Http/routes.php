<?php

Blade::setEscapedContentTags('#{{', '}}');
Blade::setContentTags('#{{{', '}}}');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


/**
 * API ROUTES
 */

Route::group(['prefix' => 'api'], function () {

    /**
     * Backend/Admin API Routes
     */
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        /**
         * Auth Routes
         */
        Route::group(['prefix' => 'auth'], function () {

            Route::post('/login', 'AuthController@authenticate');
            Route::post('/register', 'AuthController@register');
            Route::put('/settings', 'AuthController@updateSettings');
            Route::post('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);

        });

    });

});

/**
 * Admin Routes
 */

Route::group(['prefix' => 'backend', 'namespace' => 'Admin'], function () {

    /**
     * Index Route
     */
    Route::get('/login', 'IndexController@index');

    /**
     * Booking Routes
     */

    Route::group(['middleware' => ['auth']], function () {

        /**
         * Generic Index Routes
         */

        Route::get('/dashboard', 'IndexController@dashboard');
        Route::get('/settings', 'IndexController@settings');

    });

});