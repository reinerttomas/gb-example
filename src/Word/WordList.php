<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Word;

class WordList
{
    /** @var array<int, Word> */
    private array $words;

    public function __construct()
    {
        $this->words = [];
    }

    public function getWords(): array
    {
        return $this->words;
    }

    public function addWord(Word $word): void
    {
        $item = $this->contains($word);

        if ($item === null) {
            $this->words[] = $word;
        } else {
            $item->increment();
        }
    }

    public function getTheMostFrequentlyWords(int $limit): array
    {
        $words = $this->words;

        usort($words, fn(Word $a, Word $b) => $b->getCounter() <=> $a->getCounter());

        /** @var array<int, Word> $theMostFrequentlyWords */
        $theMostFrequentlyWords = [];

        for ($i = 0; $i < $limit; $i++) {
            $theMostFrequentlyWords[] = $words[$i];
        }

        return $theMostFrequentlyWords;
    }

    private function contains(Word $word): ?Word
    {
        foreach ($this->words as $item) {
            if ($word->getValue() === $item->getValue()) {
                return $item;
            }
        }

        return null;
    }
}