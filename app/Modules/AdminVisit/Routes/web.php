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

    Route::group(['prefix' => config('app.admin_url') . '/visits', "middleware" => "role:SuperAdmin|Admin|Doctor"], function () {
        Route::get('/table-visit', 'VisitController@getVisitTable')->name('adminVisitTable');
        Route::match(['post', 'get'], '/', 'VisitController@show')->name('adminVisits');
        Route::match(['post', 'get'], '/add', 'VisitController@add')->name('addVisit');
    });

    Route::post('/get/', 'VisitController@getWorktime')->name('getWorkTime');


    Route::group(['prefix' => config('app.admin_url') . '/visits/calendar', "middleware" => "role:SuperAdmin|Admin|Manager|Doctor"], function () {
        Route::match(['post', 'get'], '/add', 'VisitDoctorController@add')->name('addDocVisit');
        Route::post('/edit-status', 'VisitDoctorController@editStatus')->name('editStatus');
        Route::post('/getVisits', 'VisitDoctorController@getVisits')->name('getVisits');
        Route::post('/close-status', 'VisitDoctorController@closeStatus')->name('closeStatus');
        Route::post('/delete', 'VisitDoctorController@deleteVisit')->name('deleteDocVisit');
        Route::match(['post', 'get'], '/{id}', 'VisitDoctorController@edit')->name('editDocVisit');
    });

    Breadcrumbs::register('adminVisits', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_visits'), route('adminClinics'));
    });

    Breadcrumbs::register('addVisit', function ($breadcrumbs) {
        $breadcrumbs->parent('adminVisits');
        $breadcrumbs->push(trans('allTranslate.routes_new_visits'), route('addVisit'));
    });
});
