<?php

namespace Swac\Php\Client;

use Swac\Log;
use Swac\Php\Client\Template\ConfigClass;
use Swac\Php\Client\Template\OperationClass;
use Swac\Php\Client\Template\Readme\ReadmeMd;
use Swac\Php\Client\Template\Request\RequestClassFactory;
use Swac\Rest\Operation;
use Swac\Rest\Config;
use Swac\Rest\Renderer;
use Swaggest\PhpCodeBuilder\App\PhpApp;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFile;

class Client implements Renderer
{
    /** @var PhpClass */
    private $client;

    /** @var ConfigClass */
    private $configClass;

    /** @var PhpFile */
    private $clientFile;

    /** @var ReadmeMd */
    private $readMe;

    /** @var PhpBuilder */
    public $builder;

    /** @var PhpCode */
    private $code;

    private $app;

    private $namespace;

    private $groupByPathItems = 0;

    private $groupByTags = true;

    public $skipPathParamsInHandlerName = false;

    public function __construct($namespace, $srcPath = './src')
    {
        $this->client = new PhpClass();
        $this->client->setName('Client');

        $this->namespace = $namespace;

        $this->builder = new PhpBuilder();
        $this->builder->buildSetters = false;
        $this->builder->buildGetters = false;
        $this->builder->makeEnumConstants = true;
        $this->builder->skipSchemaDescriptions = true;

        $this->builder->baseNamespace = $this->namespace;
        $this->builder->classCreatedHook = new PhpBuilderClassCreated($this->namespace);


        $this->code = new PhpCode();

        $this->clientFile = new PhpFile($this->namespace);
        $this->clientFile->setCode($this->code);

        $this->app = new PhpApp();
        $this->app->setNamespaceRoot($this->namespace, $srcPath);

        $this->readMe = new ReadmeMd();
    }

    /**
     * Splits path by '/' and uses first `$groupByPathItems` items in namespace.
     * Default namespace is used for 0.
     * Can help to organize structure of rich API.
     *
     * @param int $groupByPathItems
     * @param bool $skipParams skip path params (enclosed in {}) in group
     * @return Client
     */
    public function setGroupByPathItems($groupByPathItems, $skipParams = true)
    {
        $this->groupByPathItems = $groupByPathItems;
        $this->skipPathParamsInHandlerName = $skipParams;
        return $this;
    }

    private function getOperationNamespace(Operation $handler)
    {
        $handlerNamespace = '';
        if ($this->groupByPathItems) {
            $path = explode('/', trim($handler->path, '/'));
            $nsItems = [];
            $limit = $this->groupByPathItems;
            foreach ($path as $k => $item) {
                if ($this->skipPathParamsInHandlerName && $item[0] === '{') {
                    unset($path[$k]);
                    continue;
                }
                $nsItems[] = PhpCode::makePhpName($item, false);
                $limit--;
                if ($limit === 0) {
                    break;
                }
            }
            $handlerNamespace = PhpCode::makePhpNamespaceName($nsItems);
        } elseif ($this->groupByTags) {
            if ($handler->tags) {
                $handlerNamespace = PhpCode::makePhpNamespaceName(array($handler->tags[0]));
            }
        }
        return $handlerNamespace;
    }

    private $handlerNames = [];

    private function getOperationName($method, $path, $operationId)
    {
        $postfix = 1;
        do {
            if ($operationId !== null) {
                $handlerName = PhpCode::makePhpName($operationId);
            } else {
                if ($this->skipPathParamsInHandlerName) {
                    $path = explode('/', trim($path, '/'));
                    if ($postfix !== 1) {
                        $path [] = 'type' . $postfix;
                    }
                    foreach ($path as $k => $item) {
                        if (!empty($item) && $item[0] === '{') {
                            unset($path[$k]);
                        }
                    }
                    $path = implode('/', $path);
                }
                $handlerName = PhpCode::makePhpName($method . '_' . $path);
            }
            $postfix += 1;
        } while (isset($this->handlerNames[$handlerName]));

        $this->handlerNames[$handlerName] = true;
        return $handlerName;
    }

    public function setConfig(Config $config)
    {
        $this->configClass = new ConfigClass($this->app, $this->namespace);
        $this->configClass->setName('Config');
        $this->configClass->setNamespace($this->namespace);

        if ($config->baseUrl) {
            $this->configClass->setBaseUrl($config->baseUrl);
        }

        if ($config->apiKeySecurityList) {
            foreach ($config->apiKeySecurityList as $apiKeySecurity) {
                $this->configClass->addApiKeySecurity($apiKeySecurity);
            }
        }

        $this->app->addClass($this->configClass);
    }


    /**
     * @param Operation $operation
     * @throws \Exception
     * @throws \Swaggest\PhpCodeBuilder\Exception
     */
    public function addOperation(Operation $operation)
    {
        Log::getInstance()->info('Processing operation', ['method' => $operation->method, 'path' => $operation->path]);

        $operationName = $this->getOperationName($operation->method, $operation->path, $operation->operationId);

        $operationClass = new OperationClass($operation, $this->builder, $this->configClass);
        $operationClass->setName(ucfirst($operationName));

        $operationNamespace = $this->getOperationNamespace($operation);
        $this->builder->classCreatedHook = new PhpBuilderClassCreated($this->namespace . $operationNamespace);

        $operationClass->setNamespace($this->namespace . $operationNamespace
            . ($this->groupByPathItems ? '' : '\\Operation'));

        $operationDesc = isset($operation->description) ? trim($operation->description) : '';
        $operationDesc .= "\nHTTP: " . strtoupper($operation->method) . ' ' . $operation->path;

        $requestClass = RequestClassFactory::make($operation, $this->builder, $this->namespace . $operationNamespace);
        $requestClass->setName(ucfirst($operationName) . 'Request');
        $operationClass->setRequestType($requestClass);

        $operationClass->setResponses($operation->responses);

        $operationClass->setDescription(wordwrap($operationDesc));
        $operationClass->build();

        $this->app->addClass($operationClass);
        $this->readMe->addHandler($operationClass);
    }

    public function store($path)
    {
        $iterator = $this->builder->getGeneratedClasses();
        foreach ($iterator as $class) {
            try {
                $this->app->addClass($class->class);
            } catch (\Exception $e) {
                Log::getInstance()->error($e->getMessage());
            }
        }

        $this->app->addFile($this->readMe->render(), './README.md');

        $this->app->store($path);
    }
}