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
    /** @var bool */
    public $requireXGenerate = false;

    /**
     * @var boolean Add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`'.
     */
    public $addRequestTags = false;

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

        $options->addRequestTags = Command\Option::create()
            ->setDescription('Add field tags with name and location to request structure properties, e.g. \'ID int `query:"id"`\'');

        $options->requireXGenerate = Command\Option::create()
            ->setDescription('Generate properties with `x-generate: true` only');
    }

    public function performAction()
    {
        $settings = new Settings();
        $settings->skipDefaultAdditionalProperties = $this->skipDefaultAdditionalProperties;
        $settings->addRequestTags = $this->addRequestTags;
        $settings->requireXGenerate = $this->requireXGenerate;
        $client = new Client($settings);

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out, $this->pkgName, $this->skipDoNotEdit);
    }
}