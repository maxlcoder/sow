<?php

namespace App\Repository;

use App\Models\MenuModel;
use App\Repository\Contract\MenuContract;

class MenuRepository extends BaseRepository implements MenuContract
{
    public function isNameExist(string $name): bool
    {
        return MenuModel::query()->where('name', $name)->exists();
    }

    public function addMenu(array $params): MenuModel
    {
        return MenuModel::query()
            ->create($params);
    }
}
