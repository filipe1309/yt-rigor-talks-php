<?php

namespace RigorTalks\Tests;

use RigorTalks\Temperature;
use RigorTalks\TemperatureNegativeException;
use PHPUnit\Framework\TestCase;

class TemperatureTest extends TestCase
{
    /**
     * @test
     */
    public function tryToCreateANonValidTemperature()
    {
        $this->expectException(TemperatureNegativeException::class);
        new Temperature(-1);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (new Temperature($measure))->measure()
        );
    }
}
