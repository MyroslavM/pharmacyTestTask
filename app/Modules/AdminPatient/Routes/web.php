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

    Route::group(['prefix' => config('app.admin_url') . '/patients', "middleware" => "role:SuperAdmin|Admin|Doctor|Manager"], function () {
        Route::get('/table-patients', 'PatientController@getPatientTable')->name('adminPatientTable');
        Route::get('/table-patient-visits/{id}', 'PatientController@getPatientVisitTable')->name('adminPatientVisitsTable');
	    Route::post('/cost-visit', 'PatientController@updateCostVisit')->name('updateVisitCost');
        Route::match(['post', 'get'], '/', 'PatientController@show')->name('adminPatients');
        Route::match(['post', 'get'], '/add', 'PatientController@add')->name('addPatient');
        Route::match(['post'], '/search', 'PatientController@search')->name('searchPatients');
        Route::post('/delete', 'PatientController@delete')->name('deletePatient');
        Route::match(['post', 'get'], '/{id}', 'PatientController@edit')->name('editPatient');
        Route::match(['post', 'get'], '/{id}/epicriz', 'PatientController@epicriz')->name('epicrizPatient');
        Route::match(['post', 'get'], '/{id}/visit', 'PatientController@visit')->name('visitPatient');
        Route::match(['post', 'get'], '/{id}/visit/{visit_id}', 'PatientController@editVisit')->name('editVisitPatient');
        Route::match(['post', 'get'], '/{id}/form043', 'PatientController@form043')->name('form043Patient');
    });

    Breadcrumbs::register('adminPatients', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_pacient'), route('adminPatients'));
    });

    Breadcrumbs::register('addPatient', function ($breadcrumbs) {
        $breadcrumbs->parent('adminPatients');
        $breadcrumbs->push(trans('allTranslate.routes_add_pacient'), route('addPatient'));
    });

    Breadcrumbs::register('editPatient', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminPatients');
        $breadcrumbs->push(trans('allTranslate.routes_edit_pacient'), route('editPatient', $item->id));
    });

	Breadcrumbs::register('epicrizPatient', function ($breadcrumbs, $item) {
		$breadcrumbs->parent('editPatient', $item);
		$breadcrumbs->push(trans('allTranslate.routes_epicriz_pacient'), route('epicrizPatient', $item->id));
	});

	Breadcrumbs::register('visitPatient', function ($breadcrumbs, $item) {
		$breadcrumbs->parent('editPatient', $item);
		$breadcrumbs->push(trans('allTranslate.routes_visit_pacient'), route('visitPatient', $item->id));
	});

	Breadcrumbs::register('form043Patient', function ($breadcrumbs, $item) {
		$breadcrumbs->parent('editPatient', $item);
		$breadcrumbs->push(trans('allTranslate.routes_form043_pacient'), route('form043Patient', $item->id));
	});
});
