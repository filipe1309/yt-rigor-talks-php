<?php

namespace RigorTalks;

class Temperature
{
    private int $measure;

    private function __construct(int $measure)
    {
        $this->setMeasure($measure);
    }

    private function setMeasure(int $measure): void
    {
        // Guard Clauses
        $this->checkMeasureIsPositive($measure);
        $this->measure = $measure;
    }

    private function checkMeasureIsPositive(int $measure): void
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException('Measure should be positive');
        }
    }

    public static function take(int $measure): Temperature
    {
        return new Temperature($measure);
    }

    public function measure(): int
    {
        return $this->measure;
    }
}
