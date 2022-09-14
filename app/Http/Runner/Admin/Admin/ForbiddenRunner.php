<?php

namespace App\Http\Runner\Admin\Admin;

use App\Enum\AdminEnum;
use App\Http\Runner\Runner;
use App\Repository\AdminRepository;

class ForbiddenRunner implements Runner
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    // 业务逻辑执行
    public function run($request)
    {
        $admin = $this->adminRepository->getAdminById($request->route('id'));
        if ($admin->state != AdminEnum::STATE_NORMAL) {
            return response_error('管理员已被禁用');
        }
        $params = [
            'state' => AdminEnum::STATE_FORBIDDEN,
        ];
        $admin->update($params);
    }
}
