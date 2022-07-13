<?php

namespace App\Http\Runner\Admin\Permission;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class StoreRunner implements Runner
{
    public function run(Request $request)
    {
        // 检查是否有同名的
        $exist = Permission::query()->where('route', $request->get('route'))->exists();
        if ($exist) {
            response_error('权限重复');
        }
        // 创建角色
        $permission = Permission::create([
            'name' => $request->get('name'),
            'route' => $request->get('route'),
        ]);
        return ['id' => $permission->id];
    }
}
