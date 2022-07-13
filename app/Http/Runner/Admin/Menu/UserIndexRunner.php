<?php

namespace App\Http\Runner\Admin\Menu;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserIndexRunner implements Runner
{
    public function run(Request $request)
    {
        // 全部菜单
        $menus = MenuModel::query()->get();

        // 用户全部权限
        $user = auth('admin')->user();
        dd($user->getAllPermissions());

        return $this->tree($menus);
    }

    public function tree(Collection $menus, $parentId = 0)
    {
        $tree = [];
        $subMenus = $menus->where('parent_id', $parentId);
        foreach ($subMenus as $subMenu) {
            $parentId = $subMenu->id;
            $subMenu->children = $this->tree($menus, $parentId);
            $tree[] = $subMenu;
        }
        return $tree;
    }

}
