<?php
Route::middleware('auth')->group(function () {
    Route::group(['namespace' => 'Branches'], function () {
        // views
        Route::group(['prefix' => 'branches'], function () {
            Route::view('/', 'branches.index')->middleware('permission:read-branches');
//            Route::view('/create', 'skus.create')->middleware('permission:create-skus');
//            Route::view('/{sku}/edit', 'skus.edit')->middleware('permission:update-skus');
        });

        // api
        Route::group(['prefix' => 'api/branches'], function () {
//            Route::get('/getBranchSkus/{sku}', 'UserController@getUserRoles');
//            Route::get('/count', 'UserController@count');
            Route::post('/filter', 'BranchController@filter')->middleware('permission:read-branches');

//            Route::get('/{sku}', 'UserController@show')->middleware('permission:read-skus');
//            Route::post('/store', 'UserController@store')->middleware('permission:create-skus');
//            Route::put('/update/{sku}', 'UserController@update')->middleware('permission:update-skus');
//            Route::delete('/{sku}', 'UserController@destroy')->middleware('permission:delete-skus');
        });
    });
});

