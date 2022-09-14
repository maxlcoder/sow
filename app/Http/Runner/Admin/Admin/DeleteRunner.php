<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Repository\AdminRepository;
use Illuminate\Support\Facades\Hash;

class DeleteRunner implements Runner
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    // 业务逻辑执行
    public function run($request)
    {
        $this->adminRepository->deleteAdminById($request->route('id'));
    }
}
