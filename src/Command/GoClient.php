<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Go\Client\Client;
use Swac\Go\Client\Settings;
use Swaggest\JsonCli\GenGo\BuilderOptions;
use Swaggest\JsonCli\Json\LoadFile;
use Yaoi\Command;
use Yaoi\Command\Definition;

class GoClient extends Base
{
    use BuilderOptions;

    public $out = './client';
    public $pkgName = 'client';
    public $skipDefaultAdditionalProperties = false;
    public $skipDoNotEdit = false;

    /**
     * @var boolean Add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`'.
     */
    public $addRequestTags = false;

    /** @var bool */
    public $withTests = false;


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

        $options->skipDoNotEdit = Command\Option::create()
            ->setDescription('Skip adding "DO NOT EDIT" comments');

        $options->addRequestTags = Command\Option::create()
            ->setDescription('Add field tags with name and location to request structure properties, e.g. \'ID int `query:"id"`\'');

        $options->withTests = Command\Option::create()
            ->setDescription('Generate (un)marshaling tests for entities (experimental feature)');

        static::setUpBuilderOptions($options);
        unset($options->enableDefaultAdditionalProperties);

        $options->skipDefaultAdditionalProperties = Command\Option::create()
            ->setDescription('Do not add field property for undefined `additionalProperties`');

        static::setupLoadFileOptions($options);
    }

    public function performAction()
    {
        $this->enableDefaultAdditionalProperties = !$this->skipDefaultAdditionalProperties;
        $builderOptions = $this->makeGoBuilderOptions();

        $settings = new Settings();
        $settings->builderOptions = $builderOptions;
        $settings->addRequestTags = $this->addRequestTags;
        $settings->withTests = $this->withTests;
        $client = new Client($settings);

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out, $this->pkgName, $this->skipDoNotEdit);
    }
}