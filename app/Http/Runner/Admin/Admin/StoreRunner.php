<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;

class StoreRunner implements Runner
{
    public function run($request)
    {
        $params = $request->safe()->only([
            'name',
            'real_name',
            'avatar',
            'email',
            'mobile',
        ]);
        $password = Hash::make($request->input('password'));
        $params['password'] = $password;
        $params['role_id'] = $request->input('role')['id'];

        $admin = AdminModel::query()
            ->create($params);
        return ['id' => $admin->id];
    }
}
