<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Scrapper\Cli\Parser\HtmlParser;

class HtmlParserTest extends TestCase
{
    public function testReturnsProducts(): void
    {
        libxml_use_internal_errors(true); // used as HTML5 elements don't seem to work with PHP DomDocument

        $file = getcwd() . '/tests/products.html';

        $parser = $this->initParser($file);
        $products = $parser->getProducts();
        $this->assertIsArray($products);
        $this->assertArrayHasKey('name', $products[0]);
        $this->assertArrayHasKey('description', $products[0]);
        $this->assertArrayHasKey('price', $products[0]);
        $this->assertArrayHasKey('discount', $products[0]);
    }

    private function initParser(string $html)
    {
        return new HtmlParser($html);
    }
}