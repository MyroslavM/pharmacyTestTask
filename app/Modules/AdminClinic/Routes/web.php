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

    Route::group(['prefix' => config('app.admin_url') . '/settings/clinics', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'ClinicController@show')->name('adminClinics');
        Route::match(['post', 'get'], '/add', 'ClinicController@add')->name('addClinic');
        Route::post('/delete', 'ClinicController@delete')->name('deleteClinic');
        Route::match(['post', 'get'], '/{id}', 'ClinicController@edit')->name('editClinic');
    });

    Breadcrumbs::register('adminClinics', function ($breadcrumbs) {
//    $breadcrumbs->parent('adminSettings');
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_klinics'), route('adminClinics'));
    });

    Breadcrumbs::register('addClinic', function ($breadcrumbs) {
        $breadcrumbs->parent('adminClinics');
        $breadcrumbs->push(trans('allTranslate.routes_add_klinics'), route('addClinic'));
    });

    Breadcrumbs::register('editClinic', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminClinics');
        $breadcrumbs->push(trans('allTranslate.routes_editing_clinic'),  route('editClinic', $item->id));
    });
});