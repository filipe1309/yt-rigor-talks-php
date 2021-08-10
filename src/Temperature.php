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
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public static function take(int $measure): self
    {
        return new static($measure);
    }

    public function measure(): int
    {
        return $this->measure;
    }
}
