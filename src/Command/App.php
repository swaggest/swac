<?php

namespace Swac\Command;

use Yaoi\Command;
use Yaoi\Command\Definition;

class App extends Command\Application
{
    static $ver = 'v0.1.7';

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
        $definition->description = 'OpenAPI/Swagger compiler, https://github.com/swaggest/swac';
        $definition->version = self::$ver;
    }
}