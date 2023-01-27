<?php

namespace Scrapper\Cli\Test\Commands;

use Scrapper\Cli\Commands\CommandInterface;

class TestClass implements CommandInterface
{

    public function runCommand(?array $argv): void
    {
        echo 'HELLO WORLD!';
    }
}