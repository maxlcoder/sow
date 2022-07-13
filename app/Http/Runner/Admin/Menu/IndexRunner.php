<?php

namespace App\Http\Runner\Admin\Menu;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class IndexRunner implements Runner
{
    public function run(Request $request)
    {
        $menus = MenuModel::query()->get();
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
