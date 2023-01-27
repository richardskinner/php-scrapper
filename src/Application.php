<?php

namespace Scrapper\Cli;

use RuntimeException;
use Scrapper\Cli\Commands\CommandRegistry;
use DI\Container;

class Application
{
    public function __construct(
        private Container $container,
        private CommandRegistry $commandRegistry,
        private int $argc,
        private array $argv
    )
    {
    }

    private function registerCommands(): void
    {
        // TODO: move so this object is built through the DI container
        $commands = include 'config/commands.php';

        foreach ($commands['commands'] as $command => $callable) {
            $this->commandRegistry->register(
                $command,
                fn(array $argv) => ($this->container->get($callable))->runCommand($argv)
            );
        }
    }

    private function getCommand(): string
    {
        $commandNamespace = explode(':', $this->argv[1]);

        return $commandNamespace[0];
    }

    public function run(): void
    {
        if ($this->argc <= 1) {
            throw new RuntimeException(' No command provided.');
        }
        $this->registerCommands();
        $command = $this->getCommand();

        call_user_func($this->commandRegistry->getCommand($command), $this->argv);

        exit(0);
    }
}