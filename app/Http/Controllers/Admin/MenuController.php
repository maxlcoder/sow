<?php

namespace App\Http\Controllers\Admin;

use App\Http\Runner\Admin\Menu\IndexRunner;
use App\Http\Runner\Admin\Menu\StoreRunner;
use App\Http\Runner\Admin\Menu\UpdateRunner;
use App\Http\Runner\Admin\Menu\UserIndexRunner;
use Illuminate\Http\Request;

class MenuController extends AdminBaseController
{

    public function index(Request $request, IndexRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }

    public function userIndex(Request $request, UserIndexRunner $userIndexRunner)
    {
        return $this->success($userIndexRunner->run($request));
    }

    public function store(Request $request, StoreRunner $storeRunner)
    {
        return $this->success($storeRunner->run($request));
    }

    public function update(Request $request, $id, UpdateRunner $updateRunner)
    {
        $request->request->set('id', $id);
        return $this->success($updateRunner->run($request));
    }
}
