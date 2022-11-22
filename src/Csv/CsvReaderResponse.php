<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Csv;

class CsvReaderResponse
{
    /** @var array<int, string> */
    private array $header;

    /** @var array<int, string> */
    private array $rows;

    public function __construct(array $rows, array $header = [])
    {
        $this->header = $header;
        $this->rows = $rows;
    }

    public function getHeader(): array
    {
        return $this->header;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}