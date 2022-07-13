<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Permission\StoreRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;
use App\Http\Runner\Admin\Permission\IndexRunner;
use App\Http\Runner\Admin\Permission\ShowRunner;
use App\Http\Runner\Admin\Permission\StoreRunner;
use App\Http\Runner\Admin\Permission\UpdateRunner;
use Illuminate\Http\Request;

class PermissionController extends AdminBaseController
{

    public function index(Request $request, IndexRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }

    public function show(Request $request, $id, ShowRunner $showRunner)
    {
        $request->request->set('id', $id);
        return $this->success($showRunner->run($request));
    }

    public function store(StoreRequest $request, StoreRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }

    public function update(UpdateRequest $request, $id, UpdateRunner $updateRunner)
    {
        $request->request->set('id', $id);
        return $this->success($updateRunner->run($request));
    }
}
