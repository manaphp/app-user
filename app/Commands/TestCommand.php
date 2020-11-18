<?php

namespace App\Commands;

use ManaPHP\Cli\Command;

class TestCommand extends Command
{
    /**
     * demo for you
     *
     * @param string $name your name
     */
    public function defaultAction($name = 'manaphp')
    {
        $this->console->debug(['hello %s!', $name]);
    }
}