<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Analyzer;

use Sentiment\Analyzer as SentimentAnalyzer;

class Analyzer
{
    private SentimentAnalyzer $analyzer;

    public function __construct()
    {
        $this->analyzer = new SentimentAnalyzer();
    }

    public function getSentiment(string $text): Sentiment
    {
        $result = $this->analyzer->getSentiment($text);

        return new Sentiment(
            $result['neg'],
            $result['neu'],
            $result['pos'],
            $result['compound'],
        );
    }
}