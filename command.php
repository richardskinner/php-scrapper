#!/usr/local/opt/php@8.1/bin/php
<?php

libxml_use_internal_errors(true); // used as HTML5 elements don't seem to work with PHP DomDocument

use Scrapper\Cli\Application;
use Scrapper\Cli\Parser\ParserProvider;

require 'vendor/autoload.php';

if ($argc == 1 || $argv[1] == '--help') {
    die('This is a command line application use --help to get available parameters');
}

$parserProvider = new ParserProvider();
$parser = $parserProvider->getParser($argv[1], $argv[2]);

$app = new Application($parser);
$app->run();
