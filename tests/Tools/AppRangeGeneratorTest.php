<?php

declare(strict_types = 1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;
use App\Tools\AppRangeGenerator;

class AppRangeGeneratorTest extends TestCase
{

    public function testRange()
    {
        $array = ['A','AA'];
        $run_func = new AppRangeGenerator();
        $result_func = $run_func->makeRange($array);
        //var_dump($result_func);
        $this->assertIsArray($result_func);
    }

    public function testInverseRange()
    {
        //fail
        $array = ['x','A'];
        $run_func = new AppRangeGenerator();
        $result_func = $run_func->makeRange($array);
        //var_dump($result_func);
        $this->assertNull($result_func);
    }
}