<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;

class RefreshRunner implements Runner
{
    public function run($request)
    {
        $token = auth('admin')->refresh();
        return ['token' => $token];
    }
}
