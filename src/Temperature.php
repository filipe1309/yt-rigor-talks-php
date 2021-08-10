<?php

namespace RigorTalks;

class Temperature
{
    private int $measure;

    public function __construct(int $measure)
    {
        // Guard Clauses
        $this->checkMeasureIsPositive($measure);

        $this->measure = $measure;

    }

    public function measure(): int
    {
        return $this->measure;
    }

    private function checkMeasureIsPositive(int $measure): void
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException('Measure should be positive');
        }
    }
}
