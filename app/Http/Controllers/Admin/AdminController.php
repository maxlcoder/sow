<?php

namespace App\Http\Controllers\Admin;

use App\Http\Runner\Admin\Admin\LoginRunner;
use App\Http\Runner\Admin\Admin\MeRunner;
use Illuminate\Http\Request;

/**
 * 业务逻辑控制器，负责接受路由分配过来的请求，并根据请求分发到不同的执行逻辑(Runner)
 * 这里执行逻辑 runner 独立注入，能够做到灵活响应。
 */

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

}