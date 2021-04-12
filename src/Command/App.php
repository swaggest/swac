<?php

namespace Swac\Command;

use Yaoi\Command;
use Yaoi\Command\Definition;

class App extends Command\Application
{
    static $ver = 'v0.1.22';

    public $phpGuzzleClient;
    public $goClient;
    public $jsClient;

    /**
     * @param Definition $definition
     * @param \stdClass|static $commandDefinitions
     */
    static function setUpCommands(Definition $definition, $commandDefinitions)
    {
        $commandDefinitions->phpGuzzleClient = PhpGuzzleClient::definition();
        $commandDefinitions->goClient = GoClient::definition();
        $commandDefinitions->jsClient = JavaScriptClient::definition();

        $definition->name = 'swac';
        $definition->description = 'OpenAPI/Swagger compiler, https://github.com/swaggest/swac';
        $definition->version = self::$ver;
    }
}