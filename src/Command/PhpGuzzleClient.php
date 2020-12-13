<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Php\Client\Client;
use Swaggest\JsonCli\GenPhp\BuilderOptions;
use Yaoi\Command;
use Yaoi\Command\Definition;

class PhpGuzzleClient extends Base
{
    use BuilderOptions;

    public $namespace;
    public $projectPath = './';

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        parent::setUpDefinition($definition, $options);
        $options->projectPath = Command\Option::create()->setType()
            ->setDescription('Path to project root, default ./');
        $options->namespace = Command\Option::create()->setType()->setIsRequired()
            ->setDescription('Project namespace');

        static::setupBuilderOptions($options);
    }

    public function performAction()
    {
        $projectPath = realpath($this->projectPath);
        if (false === $projectPath) {
            throw new ExitCode('Could not resolve path: ' . $this->projectPath, 1);
        }
        $projectPath .= '/';

        $phpClient = new Client($this->namespace, './');
        $this->setupBuilder($phpClient->builder);

        $this->process($phpClient);
        $phpClient->store($projectPath);
    }
}