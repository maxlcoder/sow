<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Lib\Util\RsaUtil;
use Illuminate\Support\Facades\Auth;


/**
 * 业务逻辑执行体，只做一件事情，通常响应一个API的处理过程
 * 该处理过程中，可以调用通用服务类 Service 和 通用持久化类 Repository 来完成业务逻辑
 *
 */
class LoginRunner implements Runner
{
    // 业务逻辑执行
    public function run($request)
    {
        $password = RsaUtil::decrypt(base64_decode($request->input('password')));

        $token = Auth::guard('admin')->attempt([
            'name' => $request->input('name'),
            'password' => $password,
        ]);
        if (!$token) {
            return response_error('用户名或密码错误');
        }
        $admin = auth('admin')->user();
        $admin->token = $token;
        $admin->expires_in = auth('admin')->factory()->getTTL() * 60;
        return $admin;
    }
}
