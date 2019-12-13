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

Route::get('/', 'Auth\LoginController@ShowLoginForm');

Route::group(['middleware' => 'auth'], function(){
    Route::resource("penginapan", "PenginapanController");
});

Route::group(['prefix' => 'kamar/', 'middleware' => 'auth'], function(){
    Route::get('lihat', 'KamarController@index');
    Route::get('tambah', 'KamarController@showTambah');
    Route::post('store', 'KamarController@store');
    Route::get('hapus/{id}', 'KamarController@delete');
    Route::get('ubah/{id}', 'KamarController@showUbah');
    Route::put('update/{id}', 'KamarController@update');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');