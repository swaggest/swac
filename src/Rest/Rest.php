<?php

namespace Swac\Rest;

use Swac\Log;

class Rest implements Renderer
{
    public $operationsFilter = [];

    public $totalOperations = 0;

    /** @var Renderer[] */
    private $renderers = [];

    /**
     * @param Renderer $renderer
     * @return $this
     */
    public function addRenderer(Renderer $renderer)
    {
        $this->renderers[] = $renderer;
        return $this;
    }


    public function setConfig(Config $config)
    {
        foreach ($this->renderers as $renderer) {
            $renderer->setConfig($config);
        }
    }

    public function addOperation(Operation $operation)
    {
        Log::getInstance()->info('Processing operation', [
            'method' => $operation->method,
            'path' => $operation->path,
        ]);
        if (!empty($this->operationsFilter)) {
            $skip = true;
            foreach ($this->operationsFilter as $filter) {
                if ($filter === $operation->method . $operation->path) {
                    $skip = false;
                    break;
                }
            }
            if ($skip) {
                Log::getInstance()->warn('Skipping operation', [
                    'method' => $operation->method,
                    'path' => $operation->path,
                ]);
                return;
            }
        }

        $this->totalOperations++;
        foreach ($this->renderers as $renderer) {
            $renderer->addOperation($operation);
        }
    }
}