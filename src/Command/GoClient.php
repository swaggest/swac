<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Go\Client\Client;
use Swac\Go\Client\Settings;
use Yaoi\Command;
use Yaoi\Command\Definition;

class GoClient extends Base
{
    public $out = './client';
    public $pkgName = 'client';
    public $skipDefaultAdditionalProperties = false;
    public $skipDoNotEdit = false;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        parent::setUpDefinition($definition, $options);

        $options->out = Command\Option::create()->setType()
            ->setDescription('Path to output package, default ./client');

        $options->pkgName = Command\Option::create()->setType()
            ->setDescription('Output package name, default "client"');

        $options->skipDefaultAdditionalProperties = Command\Option::create()
            ->setDescription('Do not add field property for undefined `additionalProperties`');

        $options->skipDoNotEdit = Command\Option::create()
            ->setDescription('Skip adding "DO NOT EDIT" comments');
    }

    public function performAction()
    {
        $settings = new Settings();
        $settings->skipDefaultAdditionalProperties = $this->skipDefaultAdditionalProperties;
        $client = new Client($settings);

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out, $this->pkgName, $this->skipDoNotEdit);
    }
}