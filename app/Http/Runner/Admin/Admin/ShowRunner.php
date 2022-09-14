<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Models\AdminModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ShowRunner implements Runner
{
    public function run($request)
    {
        return AdminModel::query()
            ->with('role:id,name')
            ->find($request->route('id'));
    }
}
