<?php

namespace Scrapper\Cli\Commands;

use Wujunze\Colors;
use Wujunze\Colors as CliColors;

class Help implements CommandInterface
{
    public function __construct()
    {
        $this->cliColors = new CliColors();
    }
    public function runCommand(?array $argv): void
    {
        echo $this->cliColors->getColoredString('Scrapper Help' . PHP_EOL, 'red');
        echo $this->cliColors->getColoredString('Usage: php command.php [command:type] [options]' . PHP_EOL);
        echo $this->cliColors->getColoredString('php command.php help' . PHP_EOL);
        echo $this->cliColors->getColoredString('php command.php parse:html [file|location]' . PHP_EOL);
    }
}