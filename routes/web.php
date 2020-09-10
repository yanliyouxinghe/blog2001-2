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

Route::get('/', function () {
    return view('layout.layout');
});
Route::get('/brand/create','Brand\BrandController@create');

Route::get('/brand/list','Brand\BrandController@index');
Route::post('/brand/store','Brand\BrandController@store');
Route::post('/brand/uploads','Brand\BrandController@uploads');
Route::get('/brand/destroy','Brand\BrandController@destroy');
Route::get('/brand/show/{id}','Brand\BrandController@show');
Route::post('/brand/edit/{id}','Brand\BrandController@edit');
Route::post('/brand/updated','Brand\BrandController@updated');
