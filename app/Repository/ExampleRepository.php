<?php

namespace App\Repository;

use App\Models\ExampleModel;
use App\Repository\Contract\ExampleContract;

class ExampleRepository extends BaseRepository implements ExampleContract
{
    public function list()
    {
        $result = ExampleModel::query()
            ->paginate();

        foreach ($result->items() as $item) {
            $item->content = 'ffff'; // 从其他 model 获取数据组合。。。。
        }
        return $result;
    }
}