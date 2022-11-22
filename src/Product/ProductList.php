<?php
declare(strict_types=1);

namespace ReinertTomas\GbExample\Product;

use ReinertTomas\GbExample\Exception\Exception;

class ProductList
{
    /** @var array<int, Product> */
    private array $products;
    private ?Product $theMostPositive;
    private ?Product $theMostNegative;

    public function __construct()
    {
        $this->products = [];
        $this->resetTheMostPositive();
        $this->resetTheMostNegative();
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
        $this->resetTheMostPositive();
        $this->resetTheMostNegative();
    }

    /**
     * @throws Exception
     */
    public function getTheMostPositive(): Product
    {
        if ($this->theMostPositive !== null) {
            return $this->theMostPositive;
        }

        $this->findTheMostPositive();

        return $this->theMostPositive;
    }

    /**
     * @throws Exception
     */
    public function getTheMostNegative(): Product
    {
        if ($this->theMostNegative !== null) {
            return $this->theMostNegative;
        }

        $this->findTheMostNegative();

        return $this->theMostNegative;
    }

    /**
     * @throws Exception
     */
    private function findTheMostPositive(): void
    {
        $this->theMostPositive = $this->products[0];

        foreach ($this->products as $product) {
            if ($product->getSentiment()->getCompound() > $this->theMostPositive->getSentiment()->getCompound()) {
                $this->theMostPositive = $product;
            }
        }
    }

    /**
     * @throws Exception
     */
    private function findTheMostNegative(): void
    {
        $this->theMostNegative = $this->products[0];

        foreach ($this->products as $product) {
            if ($product->getSentiment()->getCompound() < $this->theMostNegative->getSentiment()->getCompound()) {
                $this->theMostNegative = $product;
            }
        }
    }

    private function resetTheMostPositive(): void
    {
        $this->theMostPositive = null;
    }

    private function resetTheMostNegative(): void
    {
        $this->theMostNegative = null;
    }
}