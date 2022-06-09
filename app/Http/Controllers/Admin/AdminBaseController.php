<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AdminBaseController extends Controller
{
    // 定义父类方法
    public function success($data = null)
    {
        $response = [
            'code' => 0,
            'msg' => 'success'
        ];
        if (!is_null($data)) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }

    public function fail()
    {

    }

}