<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Example\StoreRequest;
use App\Http\Runner\Admin\Example\IndexRunner;
use App\Http\Runner\Admin\Example\StoreRunner;
use Illuminate\Http\Request;

/**
 * 业务逻辑控制器，负责接受路由分配过来的请求，并根据请求分发到不同的执行逻辑(Runner)
 * 这里执行逻辑 runner 独立注入，能够做到灵活响应。
 */

class ExampleController extends AdminBaseController
{

    public function index(Request $request, IndexRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }

    public function store(StoreRequest $request, StoreRunner $storeRunner)
    {
        // 注入参数
        $request->merge(['xx' => 'xx']);
        return $this->success($storeRunner->run($request));
    }

}