<?php

namespace RigorTalks;

class TemperatureTestClass extends Temperature
{
    protected function getThreshold(): int
    {
        return 10;
    }
}
