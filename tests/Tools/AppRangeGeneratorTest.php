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

    public function testInverseRange(): void
    {
        //fail
        $array = ['X','A'];
        $run_func = new AppRangeGenerator();
        $result_func = $run_func->makeRange($array);
        //var_dump($result_func);
        $this->assertNull($result_func);
    }

    public function testIterador(): void //falla al no iniciar en el valor estipulado
    {
        $memA = AppRangeGenerator::stringToArray('AL');
        $memB = AppRangeGenerator::stringToArray('BL');
        $array = [$memA,$memB];
        $result_func = AppRangeGenerator::iterador($array);
        var_dump($result_func);
        $this->assertIsArray($result_func);
    }

    public function testOfficeFactory(): void
    {
        $array = [
            __DIR__ . '/../../var/temp/test.txt',
            "txt",
            ["A","D"],
            ["X","AA"],
            ["AL","BX"]//genera un error de inicio
        ];

        $run_func = new AppOfficeFactory();
        $result_func = $run_func->multiRangeFactory($array);
        var_dump($result_func);
        //$this->assertNull($result_func);
        $this->assertIsArray($result_func);
    }
}