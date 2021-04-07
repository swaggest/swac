<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\JavaScript\Client\Client;
use Yaoi\Command;
use Yaoi\Command\Definition;

class JavaScriptClient extends Base
{
    public $out = './client';

    public $clientName = 'APIClient';

    public $typesPrefix = '';


    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        parent::setUpDefinition($definition, $options);

        $options->clientName = Command\Option::create()->setType()
            ->setDescription('Name of generated client class, default APIClient');

        $options->typesPrefix = Command\Option::create()->setType()
            ->setDescription('Prefix generated jsdoc class names');

        $options->out = Command\Option::create()->setType()
            ->setDescription('Path to output files, default ./client');

        static::setupLoadFileOptions($options);
    }

    public function performAction()
    {
        $client = new Client();
        $client->clientName = $this->clientName;
        $client->jsDocTypes->addNamePrefix = $this->typesPrefix;

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out);
    }
}