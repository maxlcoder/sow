<?php

namespace Tests\Feature\Admin;

use App\Models\AdminModel;
use App\Models\MenuModel;
use Faker\Factory;
use Tests\Feature\BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuTest extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * 未登录状态调用
     *
     * @return void
     */
    public function testStoreWithoutLogin()
    {
        $response = $this->header()->post('/admin/menus');
        $response->assertStatus(401);
    }

    /**
     * 登录状态调用 & 未传参
     */
    public function testStoreWithLoginWithoutParams()
    {
        // 生成持久化管理员
        $admin = AdminModel::factory()->create();
        // TODO 设置管理员
        $response = $this->header()->adminLogin($admin)->post('/admin/menus');

        // 1. 判断 http 状态码
        $response->assertStatus(422);
        // 2. 判断 返回数据结构
        $response->assertJsonStructure([
            'code',
            'msg',
        ]);
    }

    /**
     * 登录状态调用 & 特定传参
     */
    public function testStoreWithLoginWithParams()
    {
        // 生成持久化管理员
        $admin = AdminModel::factory()->create();
        // TODO 设置管理员
        $request = $this->header()->adminLogin($admin);

        // 指定数据模式
        // 组装参数
        $name = 'test_menu';
        $params = [
            'name' => $name,
        ];
        $response = $request->post('/admin/menus', $params);

        // 1. 判断 http 状态码
        $response->assertStatus(200);
        // 2. 判断 返回数据结构
        $response->assertJsonStructure([
            'code',
            'msg',
            'data' => [
                'id',
            ]
        ]);
        // 3. 判断数据
        $this->assertDatabaseHas('menu', [
            'name' => $name,
        ]);
        $result = $response->json();
        $menu = MenuModel::query()->find($result['data']['id']);
        $this->assertEquals($name, $menu->name);
    }


    /**
     * 登录状态调用 & 随机传参
     */
    public function testStoreWithLoginWithParamsRound()
    {
        // 生成持久化管理员
        $admin = AdminModel::factory()->create();
        // TODO 设置管理员
        $request = $this->header()->adminLogin($admin);

        $faker = Factory::create();
        // 随机数据模式1：自循环
        for($i = 1; $i < 2; $i++) {
            // 组装参数
            $name = $faker->name;
            $params = [
                'name' => $name,
            ];
            $response = $request->post('/admin/menus', $params);

            // 1. 判断 http 状态码
            $response->assertStatus(200);
            // 2. 判断 返回数据结构
            $response->assertJsonStructure([
                'code',
                'msg',
                'data' => [
                    'id',
                ]
            ]);
            // 3. 判断数据
            $this->assertDatabaseHas('menu', [
                'name' => $name,
            ]);
            $result = $response->json();
            $menu = MenuModel::query()->find($result['data']['id']);
            $this->assertEquals($name, $menu->name);
        }
    }


}
