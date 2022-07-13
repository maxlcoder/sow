<?php

namespace App\Http\Runner\Admin\Role;

use App\Http\Runner\Runner;
use App\Models\MenuPermissionModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UpdateRunner implements Runner
{
    public function run(Request $request)
    {
        // 检查
        $role = Role::query()->find($request->get('id'));
        if (!$role) {
            response_error('角色不存在');
        }
        // 检查角色名
        $exist = Role::query()
            ->where('name', $request->get('name'))
            ->where('id', '<>', $role->id)
            ->exists();
        if ($exist) {
            response_error('角色名被占用');
        }
        $role->update(['name' => $request->get('name')]);

        if ($request->has('menu_ids')) {
            $menuIds = $request->get('menu_ids');
            $menuIds = explode(',', $menuIds);
            // 找对应的 permission
            $permissions = MenuPermissionModel::query()->whereIn('menu_id', $menuIds)->pluck('permission_id');
            $role->syncPermissions($permissions);
        }
        return true;
    }
}
