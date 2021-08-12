<?php

namespace RigorTalks\Tests;

use RigorTalks\Temperature;
use RigorTalks\TemperatureNegativeException;
use PHPUnit\Framework\TestCase;
use RigorTalks\ColdThresholdSource;
use RigorTalks\TemperatureTestClass;

class TemperatureTest extends TestCase implements ColdThresholdSource
{
    /**
     * @test
     */
    public function tryToCreateValidTemperatureWithNamedConstructor()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (Temperature::take($measure))->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCreateANonValidTemperature()
    {
        $this->expectException(TemperatureNegativeException::class);
        Temperature::take(-1);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            (Temperature::take($measure))->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $this->assertFalse(TemperatureTestClass::take(10)->isSuperHot());
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(TemperatureTestClass::take(100)->isSuperHot());
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $this->assertTrue(TemperatureTestClass::take(10)->isSuperCold($this));
    }

    public function getThreshold(): int
    {
        return 50;
    }
}
