<?php

namespace App\Http\Runner\Admin\Permission;

use App\Http\Runner\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class IndexRunner implements Runner
{
    public function run(Request $request)
    {
        $query = Permission::query();
        if ($request->get('name')) {
            $query->where('name', 'like', '%' . $request->get('name') . '%');
        }
        return $query->orderByDesc('id')->paginate();
    }
}
