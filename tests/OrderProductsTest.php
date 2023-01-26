<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Scrapper\Cli\Parser\SortProducts;

class OrderProductsTest extends TestCase
{
    public function testOrderDesc(): void
    {
        $products = $this->getProducts();
        $expectedOrderOfProducts = $this->getExpectedOrderOfProducts();
        $orderProducts = new SortProducts();
        $orderProducts->sort($products);

        $this->assertEquals($expectedOrderOfProducts, $products);
    }

    private function getExpectedOrderOfProducts(): array
    {
        return [
            [
                "subscription" => "annually",
                "name" => "Optimum => 24GB Data - 1 Year",
                "description" => "Up to 12GB of data per year including 480 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "174.00",
                "discount" => "17.90"
            ],
            [
                "subscription" => "annually",
                "name" => "Basic => 6GB Data - 1 Year",
                "description" => "Up to 6GB of data per yearincluding 240 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "66.00",
                "discount" => "5.86"
            ],
            [
                "subscription" => "annually",
                "name" => "Standard => 12GB Data - 1 Year",
                "description" => "Up to 12GB of data per year including 420 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "15.99",
                "discount" => "11.90"
            ],
            [
                "subscription" => "monthly",
                "name" => "Optimum => 2 GB Data - 12 Months",
                "description" => "2GB data per monthincluding 40 SMS(5p \/ minute and 4p \/ SMS thereafter)",
                "price" => "108.00",
                "discount" => null
            ],
            [
                "subscription" => "monthly",
                "name" => "Standard => 1GB Data - 12 Months",
                "description" => "Up to 1 GB data per monthincluding 35 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "9.99",
                "discount" => null
            ],
            [
                "subscription" => "monthly",
                "name" => "Basic => 500MB Data - 12 Months",
                "description" => "Up to 500MB of data per monthincluding 20 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "5.99",
                "discount" => null
            ]

        ];
    }

    private function getProducts(): array
    {
        return [
            [
                "subscription" => "annually",
                "name" => "Optimum => 24GB Data - 1 Year",
                "description" => "Up to 12GB of data per year including 480 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "174.00",
                "discount" => "17.90"
            ],
            [
                "subscription" => "annually",
                "name" => "Standard => 12GB Data - 1 Year",
                "description" => "Up to 12GB of data per year including 420 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "15.99",
                "discount" => "11.90"
            ],
            [
                "subscription" => "annually",
                "name" => "Basic => 6GB Data - 1 Year",
                "description" => "Up to 6GB of data per yearincluding 240 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "66.00",
                "discount" => "5.86"
            ],
            [
                "subscription" => "monthly",
                "name" => "Optimum => 2 GB Data - 12 Months",
                "description" => "2GB data per monthincluding 40 SMS(5p \/ minute and 4p \/ SMS thereafter)",
                "price" => "108.00",
                "discount" => null
            ],
            [
                "subscription" => "monthly",
                "name" => "Standard => 1GB Data - 12 Months",
                "description" => "Up to 1 GB data per monthincluding 35 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "9.99",
                "discount" => null
            ],
            [
                "subscription" => "monthly",
                "name" => "Basic => 500MB Data - 12 Months",
                "description" => "Up to 500MB of data per monthincluding 20 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                "price" => "5.99",
                "discount" => null
            ]

        ];
    }
}