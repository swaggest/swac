<?php

namespace Swac\Command;

use Swac\ExitCode;
use Swac\Log;
use Swac\Rest\Renderer;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;
use Symfony\Component\Yaml\Yaml;
use Yaoi\Command;
use Yaoi\Command\Definition;
use Yaoi\Io\Response;

abstract class Base extends Command
{
    public $schemaPath;
    public $operations;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->schemaPath = Command\Option::create()->setType()->setIsRequired()->setIsUnnamed()
            ->setDescription('Path/URL to OpenAPI/Swagger schema');

        $options->operations = Command\Option::create()->setType()
            ->setDescription('Operations filter in form of comma-separated list of method/path, default empty');
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
        if ($this->operations) {
            $rest->operationsFilter = explode(',', $this->operations);
        }
        $rest->addRenderer($client);

        $schemaJson = self::readJsonOrYaml($this->schemaPath, $this->response);

        if (isset($schemaJson->swagger)) {
            $reader = new Reader($rest);
        } elseif (isset($schemaJson->openapi)) {
            $reader = new \Swac\OpenAPI3\Reader($rest);
        }

        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson($schemaJson);
        $reader->process();

        if ($rest->totalOperations === 0) {
            throw new ExitCode('No operations to store.', 1);
        }
    }

    /**
     * @param string $path
     * @param Response $response
     * @return mixed
     * @throws ExitCode
     */
    public static function readJsonOrYaml($path, $response)
    {
        $fileData = file_get_contents($path);
        if (!$fileData) {
            $response->error('Unable to read ' . $path);
            throw new ExitCode('', 1);
        }
        if (substr($path, -5) === '.yaml' || substr($path, -4) === '.yml') {
            $jsonData = Yaml::parse($fileData, Yaml::PARSE_OBJECT + Yaml::PARSE_OBJECT_FOR_MAP);
        } elseif (substr($path, -11) === '.serialized') {
            $jsonData = unserialize($fileData);
        } else {
            $jsonData = json_decode($fileData);
        }

        return $jsonData;
    }

}