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
    return view('auth.login');
});

//ROUTES PENGINAPAN
Route::get('/penginapan/lihat', 'PenginapanController@index');
Route::get('/penginapan/tambah', 'PenginapanController@showTambah');
Route::post('/penginapan/store', 'PenginapanController@store');
Route::get('/penginapan/hapus/{id}', 'PenginapanController@delete');
Route::get('/penginapan/ubah/{id}', 'PenginapanController@showUbah');
Route::put('/penginapan/update/{id}', 'PenginapanController@update');

//ROUTES KAMAR
Route::get('/kamar/lihat', 'KamarController@index');
Route::get('/kamar/tambah', 'KamarController@showTambah');
Route::post('/kamar/store', 'KamarController@store');
Route::get('/kamar/hapus/{id}', 'KamarController@delete');
Route::get('/kamar/ubah/{id}', 'KamarController@showUbah');
Route::put('/kamar/update/{id}', 'KamarController@update');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');