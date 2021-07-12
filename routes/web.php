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
Route::get('/', function(){

   return redirect()->route('admin.login');
});

//Route::get('test', 'TestController@test');
//Route::get('pdf-design', 'TestController@pdfDesignTest');
//Route::get('/closeSession', 'TestController@closeSession');

if ( config('app.env') == 'production' ) {
    URL::forceScheme('https');
}
