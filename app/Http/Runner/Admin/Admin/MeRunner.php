<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;

class MeRunner implements Runner
{

    // 业务逻辑执行
    public function run($request)
    {
        // 通过 jwt 获取用户信息
        $admin = auth('admin')->user();
        return $admin;
    }
}
