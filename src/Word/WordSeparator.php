<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Word;

class WordSeparator
{
    private const SPECIAL = ['.', ',', ':', ';', '"', "'", '?', '!', '-', '`'];
    private const EXCLUDE = ['and', 'but', 'or', 'for', 'nor', 'yet', 'so'];

    public function split(string $text): array
    {
        $text = strip_tags($text);
        $text = strtolower($text);
        $text = trim($text);
        $text = str_replace(self::SPECIAL, '', $text);

        /** @var array<Word> $words */
        $words = [];

        $items = explode(' ', $text);

        foreach ($items as $item) {
            if (in_array($item, self::EXCLUDE, true) === false) {
                $words[] = new Word($item);
            }
        }

        return $words;
    }
}