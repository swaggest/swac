<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\JavaScript\Client\Client;
use Swaggest\JsonCli\GenGo\BuilderOptions;
use Yaoi\Command;
use Yaoi\Command\Definition;

class JavaScriptClient extends Base
{
    use BuilderOptions;

    public $out = './client';

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        parent::setUpDefinition($definition, $options);

        $options->out = Command\Option::create()->setType()
            ->setDescription('Path to output package, default ./client');

        static::setupLoadFileOptions($options);
    }

    public function performAction()
    {
        $client = new Client();

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out);
    }
}