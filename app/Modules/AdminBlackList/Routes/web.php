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

    Route::group(['prefix' => config('app.admin_url') . '/black-list', "middleware" => "role:SuperAdmin|Admin|Doctor|Manager"], function () {
        Route::get('/table-blacklist', 'ListController@getBlackListTable')->name('adminBlackListTable');
        Route::get('/table', 'ListController@getUsersTable')->name('adminUsersTable');
        Route::match(['post', 'get'], '/', 'ListController@show')->name('adminBlackList');
        Route::get('/delete/{id}', 'ListController@delete')->name('deleteBlackList');
        Route::match(['post', 'get'], '/add', 'ListController@add')->name('addBlackList');
        Route::match(['post', 'get'], '/{id}', 'ListController@edit')->name('editBlackList');
    });

    Breadcrumbs::register('adminBlackList', function ($breadcrumbs) {
        $breadcrumbs->parent('adminSettings');
        $breadcrumbs->push(trans('allTranslate.routes_BlackList'), route('adminBlackList'));
    });


    Route::group(['prefix' => config('app.admin_url') . '/tarifs', "middleware" => "role:SuperAdmin"], function () {
        Route::get('/', 'ListController@showTarifs')->name('adminTarifs');

    });
});