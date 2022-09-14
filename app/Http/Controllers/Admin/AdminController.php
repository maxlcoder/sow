<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Http\Runner\Admin\Admin\DeleteRunner;
use App\Http\Runner\Admin\Admin\ForbiddenRunner;
use App\Http\Runner\Admin\Admin\IndexRunner;
use App\Http\Runner\Admin\Admin\LoginRunner;
use App\Http\Runner\Admin\Admin\LogoutRunner;
use App\Http\Runner\Admin\Admin\MeRunner;
use App\Http\Runner\Admin\Admin\ShowRunner;
use App\Http\Runner\Admin\Admin\RefreshRunner;
use App\Http\Runner\Admin\Admin\StoreRunner;
use App\Http\Runner\Admin\Admin\UpdateRunner;

use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{

    public function login(Request $request, LoginRunner $loginRunner)
    {
        return $this->success($loginRunner->run($request));
    }

    public function me(Request $request, MeRunner $meRunner)
    {
        return $this->success($meRunner->run($request));
    }

    public function logout(Request $request, LogoutRunner $logoutRunner)
    {
        return $this->success($logoutRunner->run($request));
    }

    public function refresh(Request $request, RefreshRunner $refreshRunner)
    {
        return $this->success($refreshRunner->run($request));
    }
    public function index(Request $request, IndexRunner $indexRunner)
    {
        return $this->success($indexRunner->run($request));
    }
    
    public function store(StoreRequest $request, StoreRunner $storeRunner)
    {
        return $this->success($storeRunner->run($request));
    }
    
    public function show(Request $request, ShowRunner $showRunner)
    {
        return $this->success($showRunner->run($request));
    }

    public function update(UpdateRequest $request, UpdateRunner $updateRunner)
    {
        return $this->success($updateRunner->run($request));
    }

    public function destroy(Request $request, DeleteRunner $deleteRunner)
    {
        return $this->success($deleteRunner->run($request));
    }

    public function forbidden(Request $request, ForbiddenRunner $forbiddenRunner)
    {
        return $this->success($forbiddenRunner->run($request));
    }
}
