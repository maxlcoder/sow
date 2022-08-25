<?php

namespace App\Http\Runner\Admin\Example;

use App\Http\Runner\Runner;
use App\Repository\Contract\ExampleContract;
use App\Repository\ExampleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


/**
 * 业务逻辑执行体，只做一件事情，通常响应一个API的处理过程
 * 该处理过程中，可以调用通用服务类 Service 和 通用持久化类 Repository 来完成业务逻辑
 *
 */
class IndexRunner implements Runner
{
    public function __construct(ExampleContract $repository)
    {
        $this->repository = $repository;
    }

    // 业务逻辑执行
    public function run(Request $request)
    {

        $res = $this->repository->earth();
        if (!empty($res)) {
            return $res;
        }

        return ['test' => 'data'];


        // 二次参数校验


        // 1. 直接 Model 输出
//        $query = ExampleModel::query();
//        if ($request->has('title') && !is_null($request->get('title'))) {
//            $query->where('title', $request->get('title'));
//        }
//        return $query->select('*')
//            ->paginate();


        // 2. repository -> model 输出
        return $this->repository->list();

        // 3. service -> repository -> model

    }
}
