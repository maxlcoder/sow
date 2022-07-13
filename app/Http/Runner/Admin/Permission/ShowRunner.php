<?php

namespace App\Http\Runner\Admin\Permission;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class ShowRunner implements Runner
{
    public function run(Request $request)
    {
        $permissionId = $request->get('id');
        $permission = Permission::query()->find($permissionId);
        if (!$permission) {
            response_error('权限不存在');
        }
        return $permission;
    }
}
