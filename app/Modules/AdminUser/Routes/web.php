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

    Route::group(['prefix' => config('app.admin_url') . '/', "middleware" => "role:SuperAdmin|Admin|Doctor|Manager"], function () {
        Route::match(['post', 'get'], '/user', 'UserController@show')->name('adminUser');
        Route::match(['post', 'get'], '/user-avatar', 'UserController@changeAvatar')->name('adminUserAvatar');
        Route::match(['post', 'get'], '/user-password', 'UserController@changePassword')->name('adminUserPassword');
        Route::match(['post', 'get'], '/users', 'UsersController@users')->name('adminUsers');
        Route::match(['post', 'get'], '/users/delete', 'UsersController@delete')->name('deleteUser');
        Route::match(['post', 'get'], '/users/add', 'UsersController@add')->name('addUsers');
        Route::match(['post', 'get'], '/users-avatar{id}', 'UsersController@changeAvatar')->name('adminUsersAvatar');
        Route::match(['post', 'get'], '/users-password/{id}', 'UsersController@changePassword')->name('adminUsersPassword');
        Route::match(['post', 'get'], '/users/{id}', 'UsersController@edit')->name('editUsers');
    });

    Route::group(['prefix' => config('app.admin_url') . '/work-time/', "middleware" => "role:SuperAdmin|Admin|Doctor|Manager"], function () {
        Route::match(['post', 'get'], '/user/{id}', 'WowrController@showItem')->name('adminWorkTime');
        Route::match(['post', 'get'], '/add/{id}', 'WowrController@addTimes')->name('addWorkTime');
        Route::match(['post', 'get'], '/delete/{id}', 'WowrController@delete')->name('deleteWorkTime');
    });

    Breadcrumbs::register('adminUser', function ($breadcrumbs) {
        $breadcrumbs->parent('adminUsers');
        $breadcrumbs->push(trans('allTranslate.routes_worker'), route('adminUser'));
    });
    Breadcrumbs::register('adminProfile', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
//    $breadcrumbs->parent('adminSettings');
        $breadcrumbs->push(trans('allTranslate.routes_profile'), route('adminUser'));
    });
    Breadcrumbs::register('adminUsers', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_workers'), route('adminUsers'));
    });
    Breadcrumbs::register('addUsers', function ($breadcrumbs) {
        $breadcrumbs->parent('adminHome');
        $breadcrumbs->push(trans('allTranslate.routes_new_workers'),  route('addUsers'));
    });
});