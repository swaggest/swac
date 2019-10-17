<?php

namespace Swac\Command;

use Yaoi\Command;
use Yaoi\Command\Definition;

class App extends Command\Application
{
    static $ver = 'v0.0.2';

    public $phpGuzzleClient;
    public $goClient;

    /**
     * @param Definition $definition
     * @param \stdClass|static $commandDefinitions
     */
    static function setUpCommands(Definition $definition, $commandDefinitions)
    {
        $commandDefinitions->phpGuzzleClient = PhpGuzzleClient::definition();
        $commandDefinitions->goClient = GoClient::definition();

        $definition->name = 'swac';
        $definition->version = self::$ver;
    }

}