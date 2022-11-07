<?php

namespace App\Http\Runner\Admin\Admin;

use App\Http\Runner\Runner;
use App\Lib\Util\RsaUtil;
use App\Repository\AdminRepository;
use Illuminate\Support\Facades\Hash;

class UpdateRunner implements Runner
{
    protected AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    // 业务逻辑执行
    public function run($request)
    {
        $params = $request->safe()->only([
            'name',
            'real_name',
            'avatar',
            'email',
            'mobile',
        ]);
        if ($request->filled('password')) {
            $password = RsaUtil::decrypt($request->input('password'));
            $params['password'] = Hash::make($password);
        }
        $params['role_id'] = $request->input('role')['id'];
        $this->adminRepository->getAdminById($request->route('id'))->update($params);
    }
}
