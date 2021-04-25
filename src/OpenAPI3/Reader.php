<?php

namespace Swac\OpenAPI3;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Swac\Log;
use Swac\Rest\ApiKeySecurity;
use Swac\Rest\Operation as RestOperation;
use Swac\Rest\Parameter;
use Swac\Rest\Response;
use Swac\Rest\Config;
use Swac\Rest\Rest;
use Swac\Skip;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Exception;
use Swaggest\OpenAPI3Schema\APIKeySecurityScheme;
use Swaggest\OpenAPI3Schema\HTTPSecurityScheme;
use Swaggest\OpenAPI3Schema\HTTPSecuritySchemeBearer;
use Swaggest\OpenAPI3Schema\MediaType;
use Swaggest\OpenAPI3Schema\OpenAPI3Schema;
use Swaggest\OpenAPI3Schema\Operation;
use Swaggest\OpenAPI3Schema\ParameterLocationParameterInCookie;
use Swaggest\OpenAPI3Schema\ParameterLocationParameterInHeader;
use Swaggest\OpenAPI3Schema\ParameterLocationParameterInPath;
use Swaggest\OpenAPI3Schema\ParameterLocationParameterInQuery;
use Swaggest\RestClient\Http\Method;

class Reader
{
    const APPLICATION_JSON = 'application/json';
    const APPLICATION_X_WWW_FORM_URLENCODED = 'application/x-www-form-urlencoded';
    const MULTIPART_FORM_DATA = 'multipart/form-data';

    /** @var string[] */
    private $schemas; // Array of json_decoded schemas

    /** @var LoggerInterface */
    private $log;

    /** @var OpenAPI3Schema */
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
        Method::TRACE,
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
            $this->log->info('Reading OpenAPI3 schema');
            $context = new Context();
            $context->applyDefaults = false;
            $context->dereference = true;

            try {
                $this->schema = OpenAPI3Schema::import($schemaData, $context);
            } catch (Exception $exception) {
                $message = $exception->getMessage();
                //print_r($message);
                $this->log->warning('Invalid swagger schema');
                foreach (explode("\n", $message) as $line) {
                    $this->log->warning($line);
                }

                $context->skipValidation = true;
                $this->schema = OpenAPI3Schema::import($schemaData, $context);
            }

            $config = new Config();
            $config->title = $this->schema->info->title;
            $config->description = $this->schema->info->description;
            $config->version = $this->schema->info->version;

            /**
             * @todo properly process variables
             * @see https://swagger.io/docs/specification/api-host-and-base-path/
             */
            if ($this->schema->servers) {
                $baseUrl = $this->schema->servers[0]->url;
                $config->baseUrl = $baseUrl;
            }

            if ($this->schema->components->securitySchemes) {
                foreach ($this->schema->components->securitySchemes as $name => $securityScheme) {
                    if ($securityScheme instanceof APIKeySecurityScheme) {
                        $apiKey = new ApiKeySecurity($name, $securityScheme->name, $securityScheme->in);
                        $apiKey->description = $securityScheme->description;
                        $config->apiKeySecurityList[] = $apiKey;
                    } elseif ($securityScheme instanceof HTTPSecurityScheme) {
                        if ($securityScheme->scheme == HTTPSecuritySchemeBearer::BEARER) {
                            $apiKey = new ApiKeySecurity($name, 'Authorization', Parameter::HEADER, 'Bearer ');
                            $apiKey->description = $securityScheme->description;
                            $config->apiKeySecurityList[] = $apiKey;
                        }
                        /**
                         * @todo add support for other schemes
                         * @see https://swagger.io/docs/specification/authentication/
                         */
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
            $operations = $pathItem->getGetPutPostDeleteOptionsHeadPatchTraceValues();
            foreach ($operations as $method => $op) {
                try {
                    $handler = $this->makeHandler($path, $method, $op);

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
                    foreach ($op->responses as $status => $openApiResponse) {
                        $response = new Response();

                        if ($status === 'default') {
                            $response->isDefault = true;
                        } else {
                            $response->statusCode = (int)$status;
                        }

                        if ($openApiResponse->schema !== null) {
                            $response->schema = $openApiResponse->schema->exportSchema();
                        }
                        if ($openApiResponse->headers !== null) {
                            foreach ($openApiResponse->headers as $headerName => $openApiHeader) {
                                $headerSchema = $openApiHeader->schema->exportSchema();

                                /**
                                 * @todo add support for string deserialization.
                                 */
                                //$headerSchema->addMeta($openApiHeader->collectionFormat, Parameter::COLLECTION_FORMAT);

                                $response->headers[$headerName] = $headerSchema;
                            }
                        }
                        $response->description = $openApiResponse->description;

                        if ($openApiResponse->content) {
                            foreach ($openApiResponse->content as $contentType => $media) {
                                $resp = clone $response;
                                $handler->accept = $contentType;
                                $resp->contentType = $contentType;
                                if ($media->schema !== null) {
                                    $resp->schema = $media->schema->exportSchema();
                                }
                                $responses[] = $resp;
                            }
                        } else {
                            $responses[] = $response;
                        }

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

    private function makeHandler($path, $method, Operation $operation)
    {
        $handler = new RestOperation();
        $handler->path = $path;
        $handler->method = $method;
        if (!$this->rest->ignoreOperationId) {
            $handler->operationId = $operation->operationId;
        }
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

        if ($operation->requestBody) {
            foreach ($operation->requestBody->content as $contentType => $body) {
                if ($contentType === self::APPLICATION_JSON) {
                    $handler->parameters[Parameter::BODY . ':' . Parameter::BODY] = self::makeBodyParameter($body);
                } elseif ($contentType === self::APPLICATION_X_WWW_FORM_URLENCODED || $contentType === self::MULTIPART_FORM_DATA) {
                    if (null !== $body->encoding) {
                        throw new Skip('Request body skipped, encoding not supported: ' . $contentType);
                    }
                    $bodySchema = $body->schema->exportSchema();
                    $required = $bodySchema->required;
                    if ($required === null) {
                        $required = [];
                    }
                    foreach ($bodySchema->properties as $propertyName => $property) {
                        $param = new Parameter();
                        $param->in = Parameter::FORM_DATA;
                        $param->name = $propertyName;
                        $param->required = in_array($propertyName, $required);
                        $param->schema = $property;
                        $param->deprecated = $body->schema->deprecated;
                        $handler->parameters[Parameter::FORM_DATA . ':' . $propertyName] = $param;
                    }
                } else {
                    throw new Skip('Request body skipped, unsupported content type: ' . $contentType);
                }
            }
        }
        return $handler;
    }

    /**
     * Make an Abstract Parameter from Swagger Parameter.
     *
     * @param \Swaggest\OpenAPI3Schema\Parameter|ParameterLocationParameterInPath|ParameterLocationParameterInQuery|ParameterLocationParameterInHeader|ParameterLocationParameterInCookie $param
     * @return Parameter
     * @throws \Exception
     */
    private static function makeParameter($param)
    {
        $p = new Parameter();
        $p->name = $param->name;
        $p->in = $param->in;
        $p->description = $param->description;
        $p->deprecated = $param->deprecated;
        $p->required = $param->required;

        if ($param->schema !== null) {
            $p->schema = $param->schema->exportSchema();
            if ($param->schema->example !== null) {
                $p->examples = [$param->schema->example];
            }
        } elseif (isset($param->content['application/json']->schema)) {
            $p->schema = $param->content['application/json']->schema->exportSchema();
            $p->isJson = true;
        } else {
            throw new Skip("No schema for parameter $param->name in $param->in");
        }

        return $p;
    }

    private static function makeBodyParameter(MediaType $param)
    {
        $p = new Parameter();
        $p->in = Parameter::BODY;
        $p->name = Parameter::BODY;
        $p->description = $param->schema->description;
        $p->deprecated = $param->schema->deprecated;
        $p->schema = $param->schema->exportSchema();
        return $p;
    }


}