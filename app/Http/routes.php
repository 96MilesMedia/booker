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
     * Front-end API Routes
     */
    Route::group(['prefix' => 'booking', 'namespace' => 'Bookings'], function () {

        // Front-end Booking Routes
        Route::put('/{id}', 'BookingController@update');
        Route::get('/{date}/{valid?}', 'BookingController@getBookingsByDate')->name("getBookingsByDate");

        // Booking Settings
    });

    Route::get('/settings/booking', 'Bookings\BookingSettingsController@get');

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

        Route::group(['prefix' => 'booking', 'namespace' => 'Bookings', 'middleware' => 'auth'], function () {

            // Admin Booking Routes
            Route::get('/all', "BookingController@all");
            Route::delete('/{id}', 'BookingController@delete')->name('deleteBooking');

            // Booking Settings
            Route::put('/settings', "BookingSettingsController@update");
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

        /**
         * Booking Routes
         */

        // Non API Booking Routes
        Route::get('/booking', "Bookings\BookingController@index");
        Route::get('/booking/view/{id}', "Bookings\BookingController@view")->name("viewBooking");
        Route::get('/booking/new', 'Bookings\BookingController@add')->name("newBooking");
        Route::put('/booking/{id}', 'Bookings\BookingController@update')->name('updateBooking');
        Route::get('/booking/date', 'Bookings\BookingController@bookingsByDate')->name("dateBooking");

        // API Booking Routes
        Route::post('/booking', "Bookings\BookingController@create");

        // Booking Settings Routes
        Route::get('/booking/settings/view', "Bookings\BookingSettingsController@view")->name('viewSettings');

    });

});