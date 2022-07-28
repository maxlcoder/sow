<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;

class StoreRunner implements Runner
{

    // 业务逻辑执行
    public function run(Request $request)
    {
        // 通过 jwt 获取用户信息
        $admin = auth('admin')->user();
        return $admin;
    }
}
