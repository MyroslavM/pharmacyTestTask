<?php




Route::group(['prefix' => LaravelLocalization::setLocale()], function () {


    Route::group(['prefix' => config('app.admin_url') . '/storage/', "middleware" => "role:SuperAdmin|Admin"], function () {

        Route::get('/category', function () {
            return view('adminstorages::category.Show');
        })->name('category');

        Route::get('/provider', function () {
            return view('adminstorages::provider.Show');
        })->name('provider');

        Route::get('/products', function () {
            return view('adminstorages::products.Show');
        })->name('productsShow');
        Route::get('/products/edit', function () {
            return view('adminstorages::products.Edit');
        })->name('productsEdit');
    });

//    Breadcrumbs::register('adminProducts', function ($breadcrumbs) {
//        $breadcrumbs->parent('adminHome');
//        $breadcrumbs->push(trans('allTranslate.routes_products'), route('adminProducts'));
//    });
//    Breadcrumbs::register('editProduct', function ($breadcrumbs, $item) {
//        $breadcrumbs->parent('adminProducts');
//        $breadcrumbs->push(trans('allTranslate.routes_edit_products'), route('editProduct', $item->id));
//    });

});