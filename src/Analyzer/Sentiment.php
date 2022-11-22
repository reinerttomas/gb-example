<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Analyzer;

class Sentiment
{
    private float $negative;
    private float $neutral;
    private float $positive;
    private float $compound;

    public function __construct(float $negative, float $neutral, float $positive, float $compound)
    {
        $this->negative = $negative;
        $this->neutral = $neutral;
        $this->positive = $positive;
        $this->compound = $compound;
    }

    public function getNegative(): float
    {
        return $this->negative;
    }

    public function getNeutral(): float
    {
        return $this->neutral;
    }

    public function getPositive(): float
    {
        return $this->positive;
    }

    public function getCompound(): float
    {
        return $this->compound;
    }
}