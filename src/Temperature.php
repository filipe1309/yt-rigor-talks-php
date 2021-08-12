<?php

namespace RigorTalks;

use PDO;

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

    public function isSuperHot(): bool
    {
        $threshold = $this->getThreshold();

        return $this->measure() > $threshold;
    }

    protected function getThreshold(): int
    {
        // It coould be also
        // $global $conn;
        $conn = new PDO('sqlite:temp', null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => true
        ]);

        $stmt = $conn->prepare(
            'SELECT hot_threshold FROM configuration_temperature'
        );
        $stmt->execute();
        return $stmt->fetch();
    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource): bool
    {
        $threshold = $coldThresholdSource->getThreshold();

        return $this->measure() < $threshold;
    }

    public static function fromStation($station): self
    {
        return new static($station->sensor()->temperature()->measure());
    }
}
