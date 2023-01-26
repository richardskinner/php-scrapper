<?php

namespace Scrapper\Cli\Parser;

class XMLParser implements ParseProductsInterface
{
    public function __construct(private ?string $xml)
    {
    }

    public function getProducts(): array
    {
        return [];
    }
}