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
Route::group(['prefix' => 'admin/options', 'middleware' => 'auth:admin','as'=>'admin.product.options.'],function() {
    Route::get('/', 'AdminProductOptionController@index')->name('index')->middleware('can:list-product-option');
    Route::get('/create', 'AdminProductOptionController@create')->name('create')->middleware('can:create-product-option');
    Route::post('/store', 'AdminProductOptionController@store')->name('store')->middleware('can:store-product-option');
    Route::get('/{id}/edit', 'AdminProductOptionController@edit')->name('edit')->middleware('can:edit-product-option');
    Route::post('/update/{id}', 'AdminProductOptionController@update')->name('update')->middleware('can:update-product-option');
    Route::delete('/delete/{id}', 'AdminProductOptionController@delete')->name('delete')->middleware('can:delete-product-option');
    //Route::POST('/upload-product-media', 'AdminProductOptionController@uploadProductMedia')->name('upload.media')->middleware('can:edit-product-option');
    Route::get('/import', 'AdminProductOptionController@importFromExcel')->name('import');

});
