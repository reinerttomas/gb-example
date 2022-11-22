<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Csv;

use ReinertTomas\GbExample\Utils\Arrays;

class CsvReader
{
    private const ALLOWED_MIME_TYPES = [
        'text/csv',
    ];

    /**
     * @throws CsvReaderException
     */
    public function read(string $file, bool $hasHeader = false, string $delimiter = ';', string $enclosure = '"'): CsvReaderResponse
    {
        $this->checkMimeType($file);

        $header = [];
        $rows = [];

        $handle = fopen($file, "r");

        if ($handle === false) {
            throw new CsvReaderException('Could not open file ' . $file);
        }

        $i = 1;

        while (($data = fgetcsv($handle, 0, $delimiter, $enclosure)) !== false) {
            if ($i === 1) {
                if ($hasHeader) {
                    $header = $data;
                } else {
                    $rows[] = $data;
                }
            } else {
                $rows[] = $data;
            }

            $i++;
        }

        fclose($handle);

        return new CsvReaderResponse($rows, $header);
    }

    /**
     * @throws CsvReaderException
     */
    private function checkMimeType(string $file): void
    {
        if (class_exists('finfo') === false) {
            throw new CsvReaderException('Unable to find php_fileinfo extension.');
        }

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);

        if ($fileInfo === false) {
            throw new CsvReaderException('Failed to open file.');
        }

        $mimeType = finfo_file($fileInfo, $file);

        if ($mimeType === false) {
            throw new CsvReaderException('Failed to get mime type.');
        }

        if (in_array($mimeType, self::ALLOWED_MIME_TYPES, true) === false) {
            throw new CsvReaderException('Not supported extension: ' . $mimeType);
        }
    }
}