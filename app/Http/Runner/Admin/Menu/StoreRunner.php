<?php

namespace App\Http\Runner\Admin\Menu;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use App\Models\MenuPermissionModel;
use App\Repository\Contract\MenuContract;
use Illuminate\Http\Request;

class StoreRunner implements Runner
{
    private $menuRepository;

    public function __construct(MenuContract $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function  run(Request $request)
    {
        if ($this->menuRepository->isNameExist($request->get('name'))) {
            return response_error('菜单名重复');
        }
        $menu = MenuModel::query()->create([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id', 0),
        ]);
        // 设置菜单权限
        if ($request->has('permissions')) {
            if (!empty($request->get('permissions'))) {
                foreach ($request->get('permissions') as $item) {
                    MenuPermissionModel::query()
                        ->create([
                            'menu_id' => $menu->id,
                            'permission_id' => $item['id'],
                        ]);
                }
            }
        }
        return ['id' => $menu->id];
    }
}
