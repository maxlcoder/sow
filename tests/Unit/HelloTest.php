<?php

namespace Tests\Unit;

use App\Service\UnitService;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    private $stack;

    protected function setUp(): void
    {
        $this->stack = [];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function testEmpty()
    {
        $this->assertEmpty($this->stack);
    }

    public function testStub()
    {
        $stub = $this->createStub(UnitService::class);

        // 配置
        $stub->method('doSomething')
            ->willReturn('foo');

        $this->assertEquals('foo', $stub->doSomething());
    }


}
