<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth.basic')->group(function () {
    Route::get('me', 'Api\UserController@self');

    Route::get('skus', 'Api\SkuController@index');

    Route::post('transact', 'Api\TransactionController@store');
});
