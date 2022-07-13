<?php

namespace App\Http\Runner\Admin\Role;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use App\Models\MenuPermissionModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ShowRunner implements Runner
{
    public function run(Request $request)
    {
        $roleId = $request->get('id');
        $role = Role::query()->find($roleId);
        if (!$role) {
            response_error('角色不存在');
        }
        $permissions = $role->permissions->pluck('id');
        $hasMenuIds = MenuPermissionModel::query()
            ->whereIn('permission_id', $permissions)
            ->pluck('menu_id')
            ->toArray();
        $menus = MenuModel::query()->get();
        $role->menus = $this->tree($menus, $hasMenuIds, 0);
        unset($role->permissions);
        return $role;
    }

    public function tree(Collection $menus, $hasMenuIds, $parentId = 0)
    {
        $tree = [];
        $subMenus = $menus->where('parent_id', $parentId);
        foreach ($subMenus as $subMenu) {
            $parentId = $subMenu->id;
            if (in_array($subMenu->id, $hasMenuIds)) {
                $subMenu->is_selected = 1;
            } else {
                $subMenu->is_selected = 0;
            }
            $subMenu->children = $this->tree($menus, $hasMenuIds, $parentId);
            $tree[] = $subMenu;
        }
        return $tree;
    }
}
