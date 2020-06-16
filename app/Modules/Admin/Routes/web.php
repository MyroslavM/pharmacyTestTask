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

    Route::get('/admin', function () {
        return redirect()->route('adminCalendar');
    })->name('adminHome');

    Breadcrumbs::for('adminHome', function ($trail) {
        $trail->push(trans('allTranslate.routes_home'), route('adminHome'));
    });


    Breadcrumbs::for('adminSettings', function ($trail) {
        $trail->parent('adminHome');
        $trail->push(trans('allTranslate.routes_settings'), route('adminHome'));
    });

});