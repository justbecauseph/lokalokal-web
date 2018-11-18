<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Skus'], function() {
        // views
        Route::group(['prefix' => 'skus'], function() {
            Route::view('/', 'skus.index')->middleware('permission:read-skus');
//            Route::view('/create', 'skus.create')->middleware('permission:create-skus');
            Route::view('/{sku}/edit', 'skus.edit')->middleware('permission:read-skus');
        });

        // api
        Route::group(['prefix' => 'api/skus'], function() {
//            Route::get('/getBranchSkus/{sku}', 'UserController@getUserRoles');
//            Route::get('/count', 'UserController@count');
            Route::post('/filter', 'SkuController@filter')->middleware('permission:read-skus');

            Route::get('/{sku}/show', 'SkuController@show')->middleware('permission:read-skus');
//            Route::post('/store', 'UserController@store')->middleware('permission:create-skus');
//            Route::put('/update/{sku}', 'UserController@update')->middleware('permission:update-skus');
//            Route::delete('/{sku}', 'UserController@destroy')->middleware('permission:delete-skus');
        });
    });
});

