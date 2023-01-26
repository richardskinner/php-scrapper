<?php

namespace Scrapper\Cli\Parser;

use RuntimeException;

class ParserProvider
{
    public function getParser(string $parser, string $fileLocation): ParseProductsInterface
    {
        switch ($parser) {
            case 'html':
                return new HtmlParser($fileLocation);
            case 'xml':
                return new XMLParser($fileLocation);
            default:
                throw new RuntimeException('No parser found.');
        }
    }
}