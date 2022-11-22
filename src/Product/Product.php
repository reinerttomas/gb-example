<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Product;

use ReinertTomas\GbExample\Analyzer\Sentiment;
use ReinertTomas\GbExample\Exception\Exception;

class Product
{
    private string $name;
    private string $description;
    private ?Sentiment $sentiment = null;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @throws Exception
     */
    public function getSentiment(): Sentiment
    {
        if ($this->sentiment === null) {
            throw new Exception('Product has not yet been analyzed.');
        }

        return $this->sentiment;
    }

    public function hasSentiment(): bool
    {
        return $this->sentiment !== null;
    }

    public function setSentiment(Sentiment $sentiment): void
    {
        $this->sentiment = $sentiment;
    }
}