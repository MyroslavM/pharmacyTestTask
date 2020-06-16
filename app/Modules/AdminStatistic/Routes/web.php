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

    Route::group(['prefix' => config('app.admin_url') . '/settings/statistic', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'StatisticController@show')->name('adminStatistic');
    });

    Breadcrumbs::register('adminStatistic', function ($breadcrumbs) {
        $breadcrumbs->parent('adminSettings');
        $breadcrumbs->push(trans('allTranslate.routes_analitic'), route('adminStatistic'));
    });
});