<?php

namespace Scrapper\Cli;

use RuntimeException;
use Scrapper\Cli\Commands\CommandInterface;
use Scrapper\Cli\Commands\Help;
use Scrapper\Cli\Commands\Parser;
use DI\Container;

class Application
{
    private array $commandRegistry = [
        'help' => Help::class,
        'parser' => Parser::class,
    ];

    public function __construct(private Container $container, private int $argc, private array $argv)
    {

    }

    public function addCommand(string $name, string $commandClass)
    {
        $this->commandRegistry[$name] = $commandClass;

        return $this;
    }

    private function getCommand(): string
    {
        if ($this->argc <= 1) {
            throw new RuntimeException('No command provided. See help for more information.');
        }

        return $this->argv[1];
    }

    public function run(): void
    {
        $commandType = $this->getCommand();
        $commandType = explode(':', $commandType);
        $commandOption = $commandType[0];

        if (empty($this->commandRegistry[$commandOption])) {
            throw new RuntimeException('No command exists. See help for more information.');
        }

        $command = $this->container->get($this->commandRegistry[$commandOption]);
        $command->runCommand($this->argv);
    }
}