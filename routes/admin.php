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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware([])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {
        Route::post('login', 'AdminController@login');
        Route::get('public-key', 'CommonController@publicKey');
    });

// 后台用户登录鉴权
Route::middleware(['auth:admin'])
    ->namespace('App\Http\Controllers\Admin')
    ->group(function () {

        // 不需要权限校验的接口
        Route::get('me', 'AdminController@me')->name('个人信息');
        Route::put('logout', 'AdminController@logout')->name('退出登录');
        Route::put('refresh', 'AdminController@refresh')->name('刷新token');
        Route::put('me', 'AdminController@updateMe')->name('修改个人信息');


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

                // 菜单
                Route::get('menus', 'MenuController@index');
                Route::post('menus', 'MenuController@store');
                Route::put('menus/{id}', 'MenuController@update');
                Route::get('user-menus', 'MenuController@userIndex');
            });
    });

