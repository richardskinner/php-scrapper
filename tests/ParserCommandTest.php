<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Scrapper\Cli\Commands\Command;
use Scrapper\Cli\Commands\Parser;
use Scrapper\Cli\Parser\ParseProductsInterface;
use Scrapper\Cli\Parser\ParserProvider;
use Wujunze\Colors;

class ParserCommandTest extends TestCase
{
    /**
     * @dataProvider getProductsArray
     */
    public function testParserCommandReturnsCorrectResponseType(array $productsArray)
    {
        $this->expectOutputString(json_encode([$productsArray], JSON_PRETTY_PRINT) . '[0m');

        $interface = $this->createMock(ParseProductsInterface::class);
        $interface->method('getProducts')->willReturn([$productsArray]);
        $mock = $this->createMock(ParserProvider::class);
        $mock->method('getParser')->willReturn($interface);

        $parserCommand = $this->initParserCommand($mock);
        $parserCommand->runCommand(['command.php', 'parser:html', 'https://test.net/']);
    }

    private function getProductsArray(): array
    {
        return [
            [
                [
                    "subscription" => "annually",
                    "name" => "Optimum => 24GB Data - 1 Year",
                    "description" => "Up to 12GB of data per year including 480 SMS(5p \/ MB data and 4p \/ SMS thereafter)",
                    "price" => "174.00",
                    "discount" => "17.90"
                ]
            ],
        ];
    }

    private function initParserCommand(ParserProvider $parserProvider): Command
    {
        return new Parser(new Colors(), $parserProvider);
    }
}