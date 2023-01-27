<?php

namespace Scrapper\Cli\Commands;

use RuntimeException;
use Scrapper\Cli\Parser\ParserProvider;
use Scrapper\Cli\Parser\SortProducts;
use Wujunze\Colors as CliColors;

class Parser extends Command
{
    public function __construct(CliColors $cliColors, private ParserProvider $parserProvider)
    {
        parent::__construct($cliColors);
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

        echo $this->output(json_encode($products, JSON_PRETTY_PRINT));
    }
}