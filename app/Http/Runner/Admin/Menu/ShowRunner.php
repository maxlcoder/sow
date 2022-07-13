<?php

namespace App\Http\Runner\Admin\Menu;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use Illuminate\Http\Request;

class ShowRunner implements Runner
{
    public function run(Request $request)
    {
        $menuId = $request->get('id');
        $menu = MenuModel::query()->find($menuId);
        if (!$menu) {
            response_error('菜单不存在');
        }
        return $menu;
    }
}
