<?php
declare(strict_types=1);

use ReinertTomas\GbExample\Analyzer\Analyzer;
use ReinertTomas\GbExample\Csv\CsvReader;
use ReinertTomas\GbExample\Product\Product;
use ReinertTomas\GbExample\Product\ProductList;
use ReinertTomas\GbExample\Word\WordList;
use ReinertTomas\GbExample\Word\WordSeparator;
use Tracy\Debugger;

require __DIR__ . '/vendor/autoload.php';

Debugger::enable(false);
Debugger::$strictMode = true;

$file = __DIR__ . '/data/dataset.csv';

$csvReader = new CsvReader();
$csvReaderResponse = $csvReader->read($file, true, ',');

$productList = new ProductList();

foreach ($csvReaderResponse->getRows() as $row) {
    $productList->addProduct(
        new Product($row[0], $row[1])
    );
}

$analyzer = new Analyzer();

foreach ($productList->getProducts() as $product) {
    $sentiment = $analyzer->getSentiment($product->getDescription());
    $product->setSentiment($sentiment);
}

$positiveProduct = $productList->getTheMostPositive();

echo "<h1>The Most Positive</h1>";
echo "<h3>{$positiveProduct->getName()}</h3>\n";
echo "<p>{$positiveProduct->getDescription()}</p>\n";

$negativeProduct = $productList->getTheMostNegative();

echo "<h1>The Most Negative</h1>";
echo "<h3>{$negativeProduct->getName()}</h3>\n";
echo "<p>{$negativeProduct->getDescription()}</p>\n";

$wordList = new WordList();
$wordSeparator = new WordSeparator();

$words = $wordSeparator->split($positiveProduct->getDescription());

foreach ($words as $word) {
    $wordList->addWord($word);
}

$words = $wordSeparator->split($negativeProduct->getDescription());

foreach ($words as $word) {
    $wordList->addWord($word);
}

$words = $wordList->getTheMostFrequentlyWords(10);

echo "<h1>The Most Frequently Words</h1>\n";
echo "<ul>\n";

foreach ($words as $word) {
    echo "<li>{$word->getValue()} - {$word->getCounter()}</li>\n";
}

echo "</ul>\n";

