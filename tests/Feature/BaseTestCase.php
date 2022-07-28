<?php

namespace Tests\Feature;

use App\Models\AdminModel;
use App\Models\UserModel;
use Tests\TestCase;

class BaseTestCase extends TestCase
{
    // ajax 请求设置
    protected function header(array $headers = [])
    {
        $headers = array_merge($headers, [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
        ]);
        $this->withHeaders($headers);
        return $this;
    }

    // 用户登录状态设置
    protected function login(UserModel $user = null)
    {
        if (!$user) {
            $user = UserModel::factory()->create();
        }
        $this->actingAs($user, 'api');
        return $this;
    }

    // 管理员登录状态设置
    protected function adminLogin(AdminModel $admin = null)
    {
        if (!$admin) {
            $admin = AdminModel::factory()->create();
        }
        $this->actingAs($admin, 'admin');
        return $this;
    }


}
