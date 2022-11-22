<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Word;

class Word
{
    private string $value;
    private int $counter;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->counter = 1;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getCounter(): int
    {
        return $this->counter;
    }

    public function increment(): void
    {
        $this->counter++;
    }
}