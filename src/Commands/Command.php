<?php

namespace Scrapper\Cli\Commands;

use Wujunze\Colors as CliColors;

abstract class Command
{
    public function __construct(private CliColors $cliColors)
    {
    }

    abstract public function runCommand(?array $argv): void;

    public function output(string $string, ?string $colour = null): string
    {
        return $this->cliColors->getColoredString($string, $colour);
    }
}