<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;

class RefreshRunner implements Runner
{
    public function run($request)
    {
        $token = auth('admin')->refresh();
        return [
            'token' => $token,
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ];
    }
}
