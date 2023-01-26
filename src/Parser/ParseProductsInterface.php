<?php

namespace Scrapper\Cli\Parser;

use DOMDocument;

interface ParseProductsInterface
{
    public function getProducts(): array;
}