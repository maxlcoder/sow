<?php

namespace Tests\Unit\Repository;

use App\Repository\MenuRepository;
//use Tests\TestCase;

use PHPUnit\Framework\TestCase;



class MenuRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function test_isNameExist()
//    {
//        $menuRepository = new MenuRepository();
//        $name = 'test';
//        $res = $menuRepository->isNameExist($name);
//        $this->assertTrue(!$res);
//
//    }

    public function testEmpty(): array
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }


}
