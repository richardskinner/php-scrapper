<?php

namespace Scrapper\Cli;

use Scrapper\Cli\Parser\SortProducts;
use Scrapper\Cli\Parser\ParseProductsInterface;

class Application
{
    public function __construct(private ParseProductsInterface $parseProducts)
    {}

    public function run(): void
    {
        $products = $this->parseProducts->getProducts();
        $order = new SortProducts();
        $order->sort($products);

        echo json_encode($products, JSON_PRETTY_PRINT);
    }
}