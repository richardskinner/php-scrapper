<?php

namespace Scrapper\Cli\Commands;

use RuntimeException;
use Scrapper\Cli\Parser\ParserProvider;
use Scrapper\Cli\Parser\SortProducts;

class Parser implements CommandInterface
{
    public function __construct(private ParserProvider $parserProvider)
    {
    }

    public function runCommand(?array $argv): void
    {
        $commandParser = explode(':', $argv[1]);
        $parser = $commandParser[1];
        $file = $argv[2] ?? null;

        if (empty($file)) {
            throw new RuntimeException('No file for/url for parser');
        }

        $parser = $this->parserProvider->getParser($parser, $file);

        $products = $parser->getProducts();
        $order = new SortProducts();
        $order->sort($products);

        echo json_encode($products, JSON_PRETTY_PRINT);
    }
}