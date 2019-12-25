<?php

use Illuminate\Http\Request;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'v1'], function() {

    Route::group(['middleware' => 'jwt.verify'], function() {
        Route::get('penginapan', 'API\PenginapanController@index');
        Route::post('penginapan/g', 'API\PenginapanController@byGender');
        Route::post('penginapan/i', 'API\PenginapanController@byID');
        Route::post('kamar/p', 'API\KamarController@byPenginapan');
        Route::post('kamar/i', 'API\KamarController@byID');
    });

    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', 'API\AuthController@register');
        Route::post('login', 'API\AuthController@login');
        Route::get('user', 'API\AuthController@getAuthenticatedUser')->middleware('jwt.verify');
    });
});
