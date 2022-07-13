<?php

namespace App\Http\Runner\Admin\Permission;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UpdateRunner implements Runner
{
    public function run(Request $request)
    {
        // 检查
        $permission = Permission::query()->find($request->get('id'));
        if (!$permission) {
            response_error('权限不存在');
        }
        // 检查权限路由
        $exist = Permission::query()
            ->where('route', $request->get('route'))
            ->where('id', '<>', $permission->id)
            ->exists();
        if ($exist) {
            response_error('权限路由已存在');
        }
        $permission->update([
            'name' => $request->get('name'),
            'route' => $request->get('route'),
        ]);
        return true;
    }
}
