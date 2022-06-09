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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware([])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::get('articles', 'ExampleController@index');
        Route::post('articles', 'ExampleController@store');
    });

Route::middleware([])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::post('login', 'AdminController@login');
    });

// 后台用户登录鉴权
Route::middleware(['auth:admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::get('me', 'AdminController@me');
    });