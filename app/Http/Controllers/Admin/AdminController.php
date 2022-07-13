<?php

namespace App\Http\Controllers\Admin;

use App\Http\Runner\Admin\Admin\LoginRunner;
use App\Http\Runner\Admin\Admin\MeRunner;
use App\Http\Runner\Admin\Example\StoreRunner;
use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{

    public function login(Request $request, LoginRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }

    public function me(Request $request, MeRunner $meRunner)
    {
        return $this->success($meRunner->run($request));
    }

    public function store(StoreRequest $request, StoreRunner $storeRunner)
    {
        return $this->success($so);
    }
}
