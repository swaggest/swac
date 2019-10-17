<?php


namespace Swac\Command;

use Swac\ExitCode;
use Swac\Go\Client\Client;
use Swac\Log;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;
use Yaoi\Command;
use Yaoi\Command\Definition;

class GoClient extends Base
{
    public $out = './client';
    public $pkgName = 'client';

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
    }

    public function performAction()
    {
        $client = new Client();

        $this->process($client);

        if (!is_dir($this->out)) {
            throw new ExitCode('Directory ' . $this->out . ' not found. Please create it.', 1);
        }
        $client->store($this->out, $this->pkgName);
    }
}