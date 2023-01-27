<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use Scrapper\Cli\Application;
use Scrapper\Cli\Test\Commands\TestClass;

class ApplicationTest extends TestCase
{
    public function testApplicationThrowsExceptionWhenCommandDoesNotExist(): void
    {
        $this->expectException(RuntimeException::class);

        $app = $this->initApplication(['command.php', 'test', 'https://test.net/']);
        $app->run();
    }

    public function testRunCommandSuccessfully()
    {
        $this->expectOutputString('HELLO WORLD!');

        $app = $this->initApplication(['command.php', 'test',]);
        $app->addCommand('test', TestClass::class);
        $app->run();
    }

    private function initApplication(array $argv)
    {
        return new Application(count($argv), $argv);
    }
}