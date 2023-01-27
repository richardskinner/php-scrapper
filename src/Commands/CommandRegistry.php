<?php

namespace Scrapper\Cli\Commands;

class CommandRegistry
{
    private array $registry = [
        'help' => Help::class,
    ];

    public function register(string $name, Callable $callable): self
    {
        $this->registry[$name] = $callable;

        return $this;
    }

    public function getCommand(string $name): Callable
    {
        return $this->registry[$name];
    }
}