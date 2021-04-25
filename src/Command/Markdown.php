<?php

namespace Swac\Command;

use Swac\Markdown\APIDoc;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Markdown extends Base
{
    public $out = 'API.md';

    public $addSchemaUrl = '';

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

        $options->addSchemaUrl = Command\Option::create()->setType()
            ->setDescription('Add schema link to the document');

        $options->typesPrefix = Command\Option::create()->setType()
            ->setDescription('Prefix generated type names');

        $options->out = Command\Option::create()->setType()
            ->setDescription('Path to output files, default ./client');

        static::setupLoadFileOptions($options);
    }

    public function performAction()
    {
        $client = new APIDoc();
        $client->markdownTypes->addNamePrefix = $this->typesPrefix;
        $client->addSchemaUrl = $this->addSchemaUrl;

        $this->process($client);
        $client->store($this->out);
    }
}