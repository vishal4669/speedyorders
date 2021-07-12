<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin/tax', 'middleware' => 'auth:admin','as'=>'admin.tax.'],function() {

    Route::get('/', 'AdminStateTaxController@index')->name('index')->middleware('can:list-product-option');
    Route::get('/create', 'AdminStateTaxController@create')->name('create')->middleware('can:create-product-option');
    Route::post('/store', 'AdminStateTaxController@store')->name('store')->middleware('can:store-product-option');
    Route::get('/{id}/edit', 'AdminStateTaxController@edit')->name('edit')->middleware('can:edit-product-option');
    Route::post('/update/{id}', 'AdminStateTaxController@update')->name('update')->middleware('can:update-product-option');
    Route::delete('/delete/{id}', 'AdminStateTaxController@destroy')->name('destroy')->middleware('can:delete-product-option');

    Route::get('/change/status/{id}', 'AdminStateTaxController@updateCategoryStatus')->name('update.status')->middleware('can:edit-product-option');

});
