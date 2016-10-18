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

Route::put('/api/booking/{id}', 'Bookings\BookingController@update');


/**
 * Admin Routes
 */


Route::group(['prefix' => 'backend', 'namespace' => 'Admin'], function () {

    // INDEX

    Route::get('/', function () {
        return view('backend.index');
    });

        // BOOKINGS

        Route::get('/booking', "Bookings\BookingController@index");

        Route::get('/booking/all', "Bookings\BookingController@all");

        Route::get('/booking/view/{id}', "Bookings\BookingController@view")->name("viewBooking");

        Route::get('/booking/new', 'Bookings\BookingController@add')->name("newBooking");

        Route::put('/booking/{id}', 'Bookings\BookingController@update')->name('updateBooking');

        Route::delete('/booking/{id}', 'Bookings\BookingController@delete')->name('deleteBooking');

        Route::get('/booking/date', 'Bookings\BookingController@bookingsByDate')->name("dateBooking");
        Route::get('/booking/{date}', 'Bookings\BookingController@getBookingsByDate')->name("getBookingsByDate");

        Route::post('/booking', "Bookings\BookingController@create");

        // Booking Settings Routes

        Route::get('/booking/settings/view', "Bookings\BookingSettingsController@view")->name('viewSettings');

        Route::get('/booking/settings', "Bookings\BookingSettingsController@get");
        Route::post('/booking/settings', "Bookings\BookingSettingsController@update");
});