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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Custom API Endpoint Routes
Route::resource('promotionalCode', 'PromotionalCodeController')->middleware('cors');
Route::resource('promotionalCodeUser', 'PromotionalCodeUserController')->middleware('cors');

// Login Endpoint Routes
Route::post('/register', 'AuthenticationController@registrateUser')->middleware('cors');
Route::post('/login', 'AuthenticationController@login')->middleware('cors');


