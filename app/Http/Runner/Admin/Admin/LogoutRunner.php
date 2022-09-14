<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;

class LogoutRunner implements Runner
{
    public function run($request)
    {
        auth('admin')->logout();
    }
}
