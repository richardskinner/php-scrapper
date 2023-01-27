<?php

namespace tests;

use DI\Container;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Scrapper\Cli\Application;
use Scrapper\Cli\Commands\CommandRegistry;
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
        $app->run();
    }

    private function initApplication(array $argv)
    {
        $container = $this->createMock(Container::class);
        $registry = $this->createMock(CommandRegistry::class);

        return new Application($container, $registry, count($argv), $argv);
    }
}