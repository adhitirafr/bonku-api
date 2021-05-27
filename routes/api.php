<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::name('login')->post('login', 'App\Http\Controllers\API\AuthController@login');
Route::name('register')->post('register', 'App\Http\Controllers\API\AuthController@register');

Route::name('verify-user')->get('verify-user/{id}', 'App\Http\Controllers\API\AuthController@verifyUser');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::name('profile.show')->get('profile', 'App\Http\Controllers\API\UserController@show');
    Route::name('profile.update')->put('profile/update', 'App\Http\Controllers\API\UserController@update');
    Route::name('profile.password.update')->put('profile/password', 'App\Http\Controllers\API\UserController@updatePassword');

    Route::get('dept/finish/{id}', 'App\Http\Controllers\API\DeptController@finishDept');

    Route::apiResource('deptor', 'App\Http\Controllers\API\DeptorController');
    Route::apiResource('dept', 'App\Http\Controllers\API\DeptController');
});