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

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperColdWithAnonClass()
    {
        $this->assertTrue(TemperatureTestClass::take(10)->isSuperCold(
            new class implements ColdThresholdSource
            {
                public function getThreshold(): int
                {
                    return 50;
                }
            }
        ));
    }

    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        $this->assertSame(
            50,
            Temperature::fromStation(
                $this
            )->measure()
        );
    }

    public function sensor(): self
    {
        return $this;
    }

    public function temperature(): self
    {
        return $this;
    }

    public function measure(): int
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToSumTwoMeasures()
    {
        $a = Temperature::take(50);
        $b = Temperature::take(50);

        $c = $a->add($b);

        $this->assertEquals(100, $c->measure());
        $this->assertNotSame($c, $a);
        $this->assertNotSame($c, $b);
    }
}
