<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Log;
use Swac\Rest\Renderer;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;
use Swaggest\JsonCli\Json\LoadFile;
use Yaoi\Command;
use Yaoi\Command\Definition;

abstract class Base extends Command
{
    use LoadFile;

    public $schema;
    public $operations;
    public $ignoreOperationId;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->schema = Command\Option::create()->setType()->setIsRequired()->setIsUnnamed()
            ->setDescription('Path/URL to OpenAPI/Swagger schema, use `-` for STDIN');

        $options->operations = Command\Option::create()->setType()
            ->setDescription('Operations filter in form of comma-separated list of method/path, default empty');

        $options->ignoreOperationId = Command\Option::create()
            ->setDescription('Ignore operationId and always name operations using method and path');
    }

    /**
     * @param Renderer $client
     * @throws ExitCode
     * @throws \Swaggest\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    protected function process(Renderer $client)
    {
        $rest = new Rest();
        $rest->ignoreOperationId = $this->ignoreOperationId;
        if ($this->operations) {
            $rest->operationsFilter = explode(',', $this->operations);
        }
        $rest->addRenderer($client);
        if ($this->schema === '-') {
            $this->schema = 'php://stdin';
        }

        $schemaJson = $this->loadFile();

        if (isset($schemaJson->swagger)) {
            $reader = new Reader($rest);
        } elseif (isset($schemaJson->openapi)) {
            $reader = new \Swac\OpenAPI3\Reader($rest);
        }

        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson($schemaJson);
        $reader->process();

        if ($rest->totalOperations === 0) {
            Log::getInstance()->warn('No operations to store.');
        }
    }
}