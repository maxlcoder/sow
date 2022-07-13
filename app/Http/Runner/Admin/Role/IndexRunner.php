<?php

namespace App\Http\Runner\Admin\Role;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class IndexRunner implements Runner
{
    public function run(Request $request)
    {
        $query = Role::query();
        if ($request->get('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }
        return $query->orderByDesc('id')->paginate();
    }
}
