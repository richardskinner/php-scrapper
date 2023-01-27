#!/usr/local/opt/php@8.1/bin/php
<?php

if (php_sapi_name() !== 'cli') {
    throw new RuntimeException('This is not running as a cli application');
}

libxml_use_internal_errors(true); // used as HTML5 elements don't seem to work with PHP DomDocument

require 'vendor/autoload.php';

use DI\Container;
use Scrapper\Cli\Application;
use Scrapper\Cli\Commands\CommandRegistry;

$container = new Container();
$commandRegistry = new CommandRegistry();
$app = new Application($container, $commandRegistry, $argc, $argv);
$app->run();
