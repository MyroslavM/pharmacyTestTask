<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {


    Route::group(['prefix' => config('app.admin_url') . '/calendar', "middleware" => "role:SuperAdmin|Admin|Doctor|Manager"], function () {
        Route::post('/getWorkTimes', 'CalendarController@getWorkTimes')->name('adminCalendar.getWorkTimes');
        Route::post('/getVisits', 'CalendarController@getVisits')->name('adminCalendar.getVisits');
        Route::match(['post', 'get'], '/', 'CalendarController@show')->name('adminCalendar');
    });

    Breadcrumbs::register('adminCalendar', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_Patient_Recording_Calendar'), route('adminCalendar'));
    });
});