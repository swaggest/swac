<?php

namespace Swac\Swagger;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Swac\Rest\Operation as RestOperation;
use Swac\Rest\Parameter;
use Swac\Rest\Response;
use Swac\Rest\Config;
use Swac\Rest\Rest;
use Swac\Skip;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\SchemaExporter;
use Swaggest\RestClient\Http\Method;
use Swaggest\SwaggerSchema\ApiKeySecurity;
use Swaggest\SwaggerSchema\BodyParameter;
use Swaggest\SwaggerSchema\FormDataParameterSubSchema;
use Swaggest\SwaggerSchema\HeaderParameterSubSchema;
use Swaggest\SwaggerSchema\Operation;
use Swaggest\SwaggerSchema\PathParameterSubSchema;
use Swaggest\SwaggerSchema\QueryParameterSubSchema;
use Swaggest\SwaggerSchema\SwaggerSchema;

class Reader
{
    /** @var string[] */
    private $schemas; // Array of json_decoded schemas

    /** @var LoggerInterface */
    private $log;

    /** @var SwaggerSchema */
    private $schema;

    /** @var Rest */
    private $rest;

    private static $methods = array(
        Method::GET,
        Method::PUT,
        Method::POST,
        Method::DELETE,
        Method::OPTIONS,
        Method::HEAD,
        Method::PATCH,
    );

    public function __construct(Rest $rest)
    {
        $this->log = new NullLogger();
        $this->rest = $rest;
    }

    /**
     * @param LoggerInterface $log
     * @return Reader
     */
    public function setLog($log)
    {
        $this->log = $log;
        return $this;
    }

    public function addSchemaJson($schemaJson)
    {
        if (is_string($schemaJson)) {
            $schemaJson = json_decode($schemaJson);
        }
        $this->schemas[] = $schemaJson;
        return $this;
    }

    /**
     * @throws Exception
     * @throws \Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    public function process()
    {
        foreach ($this->schemas as $schemaData) {
            $this->log->info('Reading swagger schema');
            $context = new Context();
            $context->applyDefaults = false;
            $context->dereference = true;

            try {
                $this->schema = SwaggerSchema::import($schemaData, $context);
            } catch (Exception $exception) {
                $message = $exception->getMessage();
                //print_r($message);
                $this->log->warning('Invalid swagger schema');
                foreach (explode("\n", $message) as $line) {
                    $this->log->warning($line);
                }

                $context->skipValidation = true;
                $this->schema = SwaggerSchema::import($schemaData, $context);
            }

            $config = new Config();
            if ($this->schema->host && $this->schema->schemes) {
                $baseUrl = $this->schema->schemes[0] . '://' . $this->schema->host . $this->schema->basePath;
                $config->baseUrl = $baseUrl;
            }

            if (!empty($this->schema->info)) {
                if (!empty($this->schema->info->title)) {
                    $config->title = $this->schema->info->title;
                }

                if (!empty($this->schema->info->description)) {
                    $config->description = $this->schema->info->description;
                }

                if (!empty($this->schema->info->version)) {
                    $config->description .= "\n\nVersion: " . $this->schema->info->version . '.';
                }
                if (!empty($this->schema->info->license)) {
                    $config->description .= "\n\nLicense: " . $this->schema->info->license->name . ' '
                        . $this->schema->info->license->url . '.';
                }
                if (!empty($this->schema->info->termsOfService)) {
                    $config->description .= "\n\nTerms of service: " . $this->schema->info->termsOfService . '.';
                }
                if (!empty($this->schema->info->contact)) {
                    $config->description .= "\n\nContact: "
                        . $this->schema->info->contact->name . ' '
                        . $this->schema->info->contact->email . ' '
                        . $this->schema->info->contact->url . '.';
                }


            }

            if ($this->schema->securityDefinitions) {
                foreach ($this->schema->securityDefinitions as $name => $apiKey) {
                    if ($apiKey instanceof ApiKeySecurity) {
                        $config->apiKeySecurityList[] = new \Swac\Rest\ApiKeySecurity($name, $apiKey->name, $apiKey->in);
                    }
                }
            }

            $this->rest->setConfig($config);
            $this->processSchema();
        }
    }


    public function processSchema()
    {
        $defaultSecurity = $this->schema->security;
        foreach ($this->schema->paths as $path => $pathItem) {
            foreach (self::$methods as $method) {
                if ($pathItem->$method) {
                    try {

                        /** @var Operation $op */
                        $op = $pathItem->$method;
                        $handler = self::makeHandler($path, $method, $op);

                        if (!isset($handler->security) && isset($defaultSecurity)) {
                            $handler->security = $defaultSecurity;
                        }

                        if (isset($pathItem->parameters)) {
                            foreach ($pathItem->parameters as $parameter) {
                                $p = self::makeParameter($parameter);
                                if (!isset($handler->parameters[$p->in . ':' . $p->name])) {
                                    $handler->parameters[$p->in . ':' . $p->name] = $p;
                                }
                            }
                        }

                        $responses = [];
                        foreach ($op->responses as $status => $swaggerResponse) {
                            $response = new Response();
                            if ($status === 'default') {
                                $response->isDefault = true;
                            } else {
                                $response->statusCode = (int)$status;
                            }

                            if ($swaggerResponse->schema !== null) {
                                if ($swaggerResponse->schema instanceof \stdClass) {
                                    throw new Skip("Unprocessed response schema in " . $path . ': ' .
                                        json_encode($swaggerResponse->schema, JSON_UNESCAPED_SLASHES));
                                }
                                $response->schema = $swaggerResponse->schema->exportSchema();
                            }
                            if ($swaggerResponse->examples) {

                            }
                            if ($swaggerResponse->headers !== null) {
                                foreach ($swaggerResponse->headers as $headerName => $swaggerHeader) {
                                    $headerSchema = $swaggerHeader->exportSchema();
                                    $headerSchema->addMeta($swaggerHeader->collectionFormat, Parameter::COLLECTION_FORMAT);

                                    $response->headers[$headerName] = $headerSchema;
                                }
                            }
                            $response->description = $swaggerResponse->description;

                            $responses[] = $response;
                        }
                        $handler->responses = $responses;

                        $this->rest->addOperation($handler);
                    } catch (Skip $skip) {
                        $this->log->warning($skip->getMessage());
                        $this->log->error($method . ' ' . $path . ' skipped');
                    }
                }
            }
        }
    }

    private static function makeHandler($path, $method, Operation $operation)
    {
        $handler = new RestOperation();
        $handler->path = $path;
        $handler->method = $method;
        $handler->description = $operation->description;
        $handler->summary = $operation->summary;
        $handler->tags = $operation->tags;
        $handler->security = $operation->security;

        if ($operation->parameters) {
            foreach ($operation->parameters as $parameter) {
                $p = self::makeParameter($parameter);
                $handler->parameters[$p->in . ':' . $p->name] = $p;
            }
        }
        return $handler;
    }

    /**
     * Make an Abstract Parameter from Swagger Parameter.
     *
     * @param BodyParameter|HeaderParameterSubSchema|FormDataParameterSubSchema|QueryParameterSubSchema|PathParameterSubSchema $param
     * @return Parameter
     * @throws Skip
     */
    private static function makeParameter($param)
    {
        $p = new Parameter();
        $p->name = $param->name;
        $p->in = $param->in;
        $p->description = $param->description;
        $p->required = $param->required;
        $p->collectionFormat = $param->collectionFormat;
        if ($param->schema !== null) {
            $p->schema = $param->schema->exportSchema();
        } else {
            if (!$param instanceof SchemaExporter) {
                throw new Skip('Parameter ' . $param->name . ' can not export schema: ' . json_encode($param));
            }
            $p->schema = $param->exportSchema();
        }
        if (true === $param->{'x-deprecated'}) {
            $p->deprecated = true;
        }

        if ($param->type === FormDataParameterSubSchema::FILE) {
            $p->isFile = true;
        }
        return $p;
    }


}