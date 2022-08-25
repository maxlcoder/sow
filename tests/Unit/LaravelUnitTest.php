<?php

namespace Tests\Unit;

use App\Models\AdminModel;
use App\Repository\ExampleRepository;
use App\Service\UnitService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Tests\TestCase;

class LaravelUnitTest extends TestCase
{
    public function testStub()
    {
        $mock = $this->mock(UnitService::class, function (MockInterface $mock) {
           $mock->shouldReceive('doSomething')->once()->andReturn('test-b');
        });

        $res = app(UnitService::class)->doSomething();
        $this->assertEquals('test-b', $res);

    }


    public function testDefaultHttp()
    {
        Http::fake();
        $admin = AdminModel::factory()->create();
        // 组装参数
        $name = 'test_menu';
        $params = [
            'name' => $name,
        ];
        $response = Http::post('/admin/menus', $params);

        $this->assertEquals($response->status(), 200);

    }

    public function testHttp()
    {
        Http::fake([
            '*/menus' => Http::response(['data' => 'test'], 400),
        ]);
        $admin = AdminModel::factory()->create();
        // 组装参数
        $name = 'test_menu';
        $params = [
            'name' => $name,
        ];
        $response = Http::post('/admin/menus', $params);

        $this->assertEquals($response->status(), 400);

    }


    public function testThroughHttp()
    {
        $mock = $this->mock(ExampleRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('earth')->once()->andReturn(['earth' => 'test']);
        });
        $admin = AdminModel::factory()->create();
        // 组装参数
        $response = $this->get('admin/articles');

        $response->assertStatus(200);

        $response->assertJson([
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'earth' => 'test',
            ],
        ]);
    }

    public function testLocalHttp()
    {
        Http::fake();

        Http::withHeaders([
            'X-First' => 'foo',
        ])->post('http://example.com/users', [
            'name' => 'Taylor',
            'role' => 'Developer',
        ]);

        Http::assertSent(function (Request $request) {
            return $request->hasHeader('X-First', 'foo') &&
                $request->url() == 'http://example.com/users' &&
                $request['name'] == 'Tayloqr' &&
                $request['role'] == 'Developer';
        });

    }


}
