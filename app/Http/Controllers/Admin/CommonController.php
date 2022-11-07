<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Menu\StoreRequest;
use App\Http\Runner\Admin\Common\PublicKeyRunner;
use App\Http\Runner\Admin\Menu\IndexRunner;
use App\Http\Runner\Admin\Menu\StoreRunner;
use App\Http\Runner\Admin\Menu\UpdateRunner;
use App\Http\Runner\Admin\Menu\UserIndexRunner;
use Illuminate\Http\Request;

class CommonController extends AdminBaseController
{

    public function publicKey(Request $request, PublicKeyRunner $runner)
    {
        return $this->success($runner->run($request));
    }
}
