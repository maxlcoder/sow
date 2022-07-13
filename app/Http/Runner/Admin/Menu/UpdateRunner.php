<?php

namespace App\Http\Runner\Admin\Menu;

use App\Http\Runner\Runner;
use App\Models\MenuModel;
use App\Models\MenuPermissionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UpdateRunner implements Runner
{
    public function run(Request $request)
    {
        $menuId = $request->get('id');
        $menu = MenuModel::query()->find($menuId);
        if (!$menu) {
            response_error('菜单不存在');
        }

        $menu->update([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
        ]);

        // 设置菜单权限
        if ($request->has('permissions')) {
            if (!empty($request->get('permissions'))) {
                foreach ($request->get('permissions') as $item) {
                    MenuPermissionModel::query()
                        ->firstOrCreate([
                            'menu_id' => $menu->id,
                            'permission_id' => $item['id'],
                        ]);
                }
                // 删除其他权限
                MenuPermissionModel::query()
                    ->where('menu_id', $menu->id)
                    ->whereNotIn('permission_id', Arr::pluck($request->get('permissions'), 'id'))
                    ->delete();
            } else {

            }
        }
        return ['id' => $menu->id];
    }
}
