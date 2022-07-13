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
        // 不需要权限校验的接口
        Route::get('me', 'AdminController@me');


        // 需要权限校验的接口
        Route::middleware(['permission'])
            ->group(function () {
                // 角色处理
                Route::get('roles', 'RoleController@index');
                Route::post('roles', 'RoleController@store');
                Route::put('roles/{id}', 'RoleController@update');
                Route::get('roles/{id}', 'RoleController@show');

                // 权限
                Route::get('permissions', 'PermissionController@index');
                Route::post('permissions', 'PermissionController@store');
                Route::put('permissions/{id}', 'PermissionController@update');
                Route::get('permissions/{id}', 'PermissionController@show');

                Route::get('menus', 'MenuController@index');
                Route::post('menus', 'MenuController@store');
                Route::put('menus/{id}', 'MenuController@update');
                Route::get('user-menus', 'MenuController@userIndex');
            });
    });

