<?php

namespace App\Http\Runner\Admin\Role;

use App\Http\Runner\Runner;
use App\Models\MenuPermissionModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class StoreRunner implements Runner
{
    public function run(Request $request)
    {
        // 检查是否有同名的
        $exist = Role::query()->where('name', $request->get('name'))->exists();
        if ($exist) {
            response_error('角色名重复');
        }
        // 创建角色
        $role = Role::create(['name' => $request->get('name')]);
        // 角色分配权限
        $menuIds = explode(',', $request->get('menu_ids'));
        // 找对应的 permission
        $permissions = MenuPermissionModel::query()->whereIn('menu_id', $menuIds)->pluck('permission_id');
        $role->syncPermissions($permissions);
        return true;
    }
}
