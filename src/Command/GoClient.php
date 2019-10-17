<?php


namespace Swac\Command;

use Swac\ExitCode;
use Swac\Go\Client\Client;
use Swac\Log;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;
use Yaoi\Command;
use Yaoi\Command\Definition;

class GoClient extends Command
{
    public $schemaPath;
    public $out = './client';
    public $pkgName = 'client';
    public $operations;

    /**
     * @param Definition $definition
     * @param \stdClass|static $options
     */
    static function setUpDefinition(Definition $definition, $options)
    {
        $options->schemaPath = Command\Option::create()->setType()->setIsRequired()->setIsUnnamed()
            ->setDescription('Path to swagger.json');

        $options->out = Command\Option::create()->setType()
            ->setDescription('Path to output package, default ./client');

        $options->pkgName = Command\Option::create()->setType()
            ->setDescription('Output package name, default "client"');

        $options->operations = Command\Option::create()->setType()
            ->setDescription('Operations filter in form of comma-separated list of method/path, default empty');


    }

    public function performAction()
    {
        $rest = new Rest();
        $client = new Client();
        $rest->addRenderer($client);
        if ($this->operations) {
            $rest->operationsFilter = explode(',', $this->operations);
        }

        $reader = new Reader($rest);
        $reader->setLog(Log::getInstance());
        $schemaJson = json_decode(file_get_contents($this->schemaPath));

        $reader->addSchemaJson($schemaJson);
        $reader->process();

        if ($rest->totalOperations > 0) {
            if (!is_dir($this->out)) {
                throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
            }
            $client->store($this->out, $this->pkgName);
        } else {
            throw new ExitCode('No operations to store.', 1);
        }
    }
}