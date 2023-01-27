<?php

namespace Scrapper\Cli\Commands;

use Wujunze\Colors;
use Wujunze\Colors as CliColors;

class Help extends Command
{
    public function runCommand(?array $argv): void
    {
        echo $this->output('Scrapper Help' . PHP_EOL, 'red');
        echo $this->output('Usage: php command.php [command:type] [options]' . PHP_EOL);
        echo $this->output('php command.php help' . PHP_EOL);
        echo $this->output('php command.php parse:html [file|location]' . PHP_EOL);
    }
}