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

    Route::group(['prefix' => config('app.admin_url') . '/fields/products', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'ProductController@show')->name('adminProducts');
        Route::match(['post', 'get'], '/add', 'ProductController@add')->name('addProduct');
        Route::post('/delete', 'ProductController@delete')->name('deleteProduct');
        Route::match(['post', 'get'], '/{id}', 'ProductController@edit')->name('editProduct');
    });

    Breadcrumbs::register('adminProducts', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_products'), route('adminProducts'));
    });
    Breadcrumbs::register('editProduct', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminProducts');
        $breadcrumbs->push(trans('allTranslate.routes_edit_products'), route('editProduct', $item->id));
    });


    Route::group(['prefix' => config('app.admin_url') . '/fields/services', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'ServicesController@show')->name('adminServices');
        Route::match(['post', 'get'], '/add', 'ServicesController@add')->name('addService');
        Route::post('/delete', 'ServicesController@delete')->name('deleteService');
        Route::match(['post', 'get'], '/{id}', 'ServicesController@edit')->name('editService');
    });

    Breadcrumbs::register('adminServices', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_services'), route('adminServices'));
    });
    Breadcrumbs::register('editService', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminServices');
        $breadcrumbs->push(trans('allTranslate.routes_edit_services'), route('editService', $item->id));
    });


    Route::group(['prefix' => config('app.admin_url') . '/fields/diseases', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'DiseaseController@show')->name('adminDiseases');
        Route::match(['post', 'get'], '/add', 'DiseaseController@add')->name('addDisease');
        Route::post('/delete', 'DiseaseController@delete')->name('deleteDisease');
        Route::match(['post', 'get'], '/{id}', 'DiseaseController@edit')->name('editDisease');
    });

    Breadcrumbs::register('adminDiseases', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_diagnosis'), route('adminDiseases'));
    });
    Breadcrumbs::register('editDisease', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminDiseases');
        $breadcrumbs->push(trans('allTranslate.routes_edit_diagnosis'), route('editDisease', $item->id));
    });


    Route::group(['prefix' => config('app.admin_url') . '/fields/manipulations', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'ManipulationController@show')->name('adminManipulations');
        Route::match(['post', 'get'], '/add', 'ManipulationController@add')->name('addManipulation');
        Route::post('/delete', 'ManipulationController@delete')->name('deleteManipulation');
        Route::match(['post', 'get'], '/{id}', 'ManipulationController@edit')->name('editManipulation');
    });

    Breadcrumbs::register('adminManipulations', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_manipulations'), route('adminManipulations'));
    });
    Breadcrumbs::register('editManipulation', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminManipulations');
        $breadcrumbs->push(trans('allTranslate.routes_edit_manipulations'), route('editManipulation', $item->id));
    });


    Route::group(['prefix' => config('app.admin_url') . '/fields/marketing', "middleware" => "role:SuperAdmin|Admin"], function () {
        Route::match(['post', 'get'], '/', 'MarketingController@show')->name('adminMarketings');
        Route::match(['post', 'get'], '/add', 'MarketingController@add')->name('addMarketing');
        Route::post('/delete', 'MarketingController@delete')->name('deleteMarketing');
        Route::match(['post', 'get'], '/{id}', 'MarketingController@edit')->name('editMarketing');
    });

    Breadcrumbs::register('adminMarketings', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_marketing'), route('adminMarketings'));
    });

    Breadcrumbs::register('editMarketing', function ($breadcrumbs, $item) {
        $breadcrumbs->parent('adminMarketings');
        $breadcrumbs->push(trans('allTranslate.routes_edit_marketing'), route('editMarketing', $item->id));
    });
});