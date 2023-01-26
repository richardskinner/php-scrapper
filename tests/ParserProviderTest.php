<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Scrapper\Cli\Parser\HtmlParser;
use Scrapper\Cli\Parser\ParserProvider;
use Scrapper\Cli\Parser\XMLParser;

class ParserProviderTest extends TestCase
{
    /**
     * @dataProvider getParser
     */
    public function testReturnsCorrectParserInstance(string $type, string $expectClass, string $fileLocation)
    {
        $parserProvider = $this->initProvider();
        $parser = $parserProvider->getParser($type, $fileLocation);


        $this->assertInstanceOf($expectClass, $parser);
    }

    private function initProvider()
    {
        return new ParserProvider();
    }

    public function getParser()
    {
        return [
            ['html', HtmlParser::class, getcwd() . '/tests/products.html'],
            ['xml', XMLParser::class, getcwd() . '/tests/products.xml'],
        ];
    }
}