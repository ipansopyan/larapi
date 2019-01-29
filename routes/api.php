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

Route::group(['middleware' => ['api']], function(){
    Route::post('/auth/signup','AuthController@signup');
    Route::post('/auth/signin','AuthController@signin');

    Route::group(['middleware' => ['jwt.auth']], function(){
        Route::post('/profile','UserController@show');
        Route::post('/tutorial','TutorialController@store');
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });