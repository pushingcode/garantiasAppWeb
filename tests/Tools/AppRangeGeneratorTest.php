<?php

declare(strict_types = 1);

namespace App\Tests\Tools;

use PHPUnit\Framework\TestCase;
use App\Tools\AppRangeGenerator;
use App\Tools\AppOfficeFactory;

class AppRangeGeneratorTest extends TestCase
{

    public function testRange(): void
    {
        $array = ['AL','AZ'];
        $run_func = new AppRangeGenerator();
        $result_func = $run_func->makeRange($array);
        var_dump($result_func);
        $this->assertIsArray($result_func);
    }

    /*public function testInverseRange(): void
    {
        //fail
        $array = ['X','A'];
        $run_func = new AppRangeGenerator();
        $result_func = $run_func->makeRange($array);
        //var_dump($result_func);
        $this->assertNull($result_func);
    }*/

    public function testIterador(): void
    {
        $memA = 'X';
        $memB = 'AL';
        $result_func = AppRangeGenerator::getRange($memA,$memB);
        var_dump($result_func);
        $this->assertIsArray($result_func);
    }

    public function testOfficeFactory(): void
    {
        $array = [
            __DIR__ . '/../../var/temp/test.txt',
            "txt",
            ["A","D"],
            ["AL","BX"]//genera un error de inicio
        ];

        $run_func = new AppOfficeFactory();
        $result_func = $run_func->multiRangeFactory($array);
        var_dump($result_func);
        //$this->assertNull($result_func);
        $this->assertIsArray($result_func);
    }

    public function testStringToArray(): void
    {
        $memA = AppRangeGenerator::stringToArray('A');
        $memB = AppRangeGenerator::stringToArray('XL');

        var_dump($memA, $memB);
        $this->assertIsArray($memB);
    }
}