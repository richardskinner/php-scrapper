<?php

namespace Scrapper\Cli\Test\Commands;

use Scrapper\Cli\Commands\Command;

class TestClass extends Command
{
    public function runCommand(?array $argv): void
    {
        echo 'HELLO WORLD!';
    }
}