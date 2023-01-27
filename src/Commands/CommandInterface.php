<?php

namespace Scrapper\Cli\Commands;

interface CommandInterface
{
    public function runCommand(?array $argv): void;
}