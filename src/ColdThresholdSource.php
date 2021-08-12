<?php

namespace RigorTalks;

interface ColdThresholdSource
{
    public function getThreshold(): int;
}
