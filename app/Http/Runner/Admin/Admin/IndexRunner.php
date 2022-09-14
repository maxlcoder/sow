<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Repository\AdminRepository;
use Illuminate\Database\Eloquent\Builder;

class IndexRunner implements Runner
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function run($request)
    {
        $perPage = $request->query('per_page', 10);
        $where = function (Builder $query) use ($request) {
            if ($request->query('name')) {
                $query->where('name', 'like', '%' . $request->query('name') . '%');
            }
        };
        $field = ['*'];

        return $this->adminRepository->getAdmins($where, $field, $perPage);
    }
}
