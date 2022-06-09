<?php

namespace App\Http\Runner\Admin\Example;

use App\Http\Runner\Runner;
use App\Models\ExampleModel;
use Illuminate\Http\Request;

class StoreRunner implements Runner
{

    // 业务逻辑执行
    public function run(Request $request)
    {
        ExampleModel::query()
            ->create([
                'title' => $request->get('title'),
                'content' =>  $request->get('content') ?? '',
            ]);
    }
}