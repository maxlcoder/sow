<?php

namespace App\Repository;

use App\Models\ExampleModel;
use App\Repository\Contract\ExampleContract;
use Illuminate\Support\Facades\Http;

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

    public function earth()
    {
        $res = Http::get('https://apis.map.qq.com/ws/geocoder/v1/?address=北京市海淀区彩和坊路海淀西大街74号&key=NJRBZ-MAIK6-DCASW-MTT6A-TEGNS-E3F5Q');

        if ($res->ok()) {
            return $res->json();
        }

        return [];

    }
}
