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

Route::post('/register', 'AuthenticationController@registrateUser')->middleware('cors');
Route::post('/login', 'AuthenticationController@login')->middleware('cors');
Route::post('/logout', 'AuthenticationController@logout')->middleware('cors');
Route::get('getAllPromotionalCodes', 'PromotionalCodeController@showAll')->middleware('cors');
Route::post('addCodeToUser', 'PromotionalCodeUserController@store')->middleware('cors');
Route::post('activateCode', 'PromotionalCodeUserController@setActive')->middleware('cors');
Route::get('getAllPromotionalCodesFromUser/{user_id}', 'PromotionalCodeUserController@getPromotionalCodesFromUser')->middleware('cors');
Route::get('checkUserHasPromotionalCode/{promotional_code_user}/{user_id}', 'PromotionalCodeUserController@userHasPromotionalCode')->middleware('cors');
