<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Go\Client\Client;
use Swac\Go\Client\Settings;
use Swaggest\GoCodeBuilder\JsonSchema\Options;
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

    public $showConstProperties = false;
    /** @var bool */
    public $keepParentInPropertyNames = false;
    /** @var bool */
    public $ignoreNullable;
    /** @var bool */
    public $ignoreXGoType;
    /** @var bool */
    public $withZeroValues;
    /** @var bool */
    public $fluentSetters;
    /** @var bool */
    public $ignoreRequired = false;
    /** @var bool */
    public $withTests = false;

    /** @var array */
    public $renames = [];

    /** @var bool */
    public $validateRequired = false;


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

        $options->showConstProperties = Command\Option::create()
            ->setDescription('Show properties with constant values, hidden by default');

        $options->keepParentInPropertyNames = Command\Option::create()
            ->setDescription('Keep parent prefix in property name, removed by default');

        $options->ignoreNullable = Command\Option::create()
            ->setDescription('Add `omitempty` to nullable properties, removed by default');

        $options->ignoreXGoType = Command\Option::create()
            ->setName('ignore-x-go-type')
            ->setDescription('Ignore `x-go-type` in schema to skip generation');

        $options->withZeroValues = Command\Option::create()
            ->setDescription('Use pointer types to avoid zero value ambiguity');

        $options->fluentSetters = Command\Option::create()
            ->setDescription('Add fluent setters to struct fields');

        $options->ignoreRequired = Command\Option::create()
            ->setDescription('Ignore if property is required when deciding on pointer type or omitempty');

        $options->renames = Command\Option::create()->setIsVariadic()->setType()
            ->setDescription('Map of exported symbol renames, example From:To');

        $options->withTests = Command\Option::create()
            ->setDescription('Generate (un)marshaling tests for entities (experimental feature)');

        $options->requireXGenerate = Command\Option::create()
            ->setDescription('Generate properties with `x-generate: true` only');

        $options->validateRequired = Command\Option::create()
            ->setDescription('Generate validation code to check required properties during unmarshal');

    }

    public function performAction()
    {
        $builderOptions = new Options();
        $builderOptions->hideConstProperties = !$this->showConstProperties;
        $builderOptions->trimParentFromPropertyNames = !$this->keepParentInPropertyNames;
        $builderOptions->ignoreNullable = $this->ignoreNullable;
        $builderOptions->ignoreXGoType = $this->ignoreXGoType;
        $builderOptions->withZeroValues = $this->withZeroValues;
        $builderOptions->fluentSetters = $this->fluentSetters;
        $builderOptions->ignoreRequired = $this->ignoreRequired;
        $builderOptions->requireXGenerate = $this->requireXGenerate;
        $builderOptions->validateRequired = $this->validateRequired;
        $builderOptions->defaultAdditionalProperties = !$this->skipDefaultAdditionalProperties;
        $builderOptions->requireXGenerate = $this->requireXGenerate;
        if (!empty($this->renames)) {
            foreach ($this->renames as $rename) {
                $rename = explode(':', $rename, 2);
                $builderOptions->renames[$rename[0]] = $rename[1];
            }
        }


        $settings = new Settings();
        $settings->builderOptions = $builderOptions;
        $settings->addRequestTags = $this->addRequestTags;
        $client = new Client($settings);

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out, $this->pkgName, $this->skipDoNotEdit);
    }
}