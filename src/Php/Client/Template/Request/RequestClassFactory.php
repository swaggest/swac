<?php

namespace Swac\Php\Client\Template\Request;

use Swac\Log;
use Swac\Rest\Operation;
use Swac\Rest\Parameter;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Exception;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpCode;

class RequestClassFactory
{
    /**
     * @param Operation $handler
     * @param PhpBuilder $builder
     * @param string $namespace
     * @return \Swaggest\PhpCodeBuilder\PhpClass
     * @throws \Swaggest\PhpCodeBuilder\Exception
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
     */
    public static function make(Operation $handler, PhpBuilder $builder, $namespace)
    {
        $requestMakeUrl = new MakeUrlFunc('makeUrl');
        $requestMakeUrl->path = $handler->path;
        $requestMakeHeaders = new MakeHeadersFunc('makeHeaders');
        $requestMakeBody = new MakeBodyFunc('makeBody');

        $requestSchema = new Schema();

        $requestMakeHeaders->accept = $handler->accept;

        foreach ($handler->responses as $response) {
            if ($response->schema !== null) {
                $requestMakeHeaders->acceptJson = true;
                break;
            }
        }

        if ($handler->parameters) {
            $requestSchema->type = 'object';
            $requestSchema->properties = new Properties();
            $requestSchema->required = [];


            foreach ($handler->parameters as $parameter) {
                $parameterName = $parameter->name;
                $parameter->schema->addMeta($parameter);

                if ($parameter->in === Parameter::QUERY) {
                    $requestMakeUrl->queryParameters[$parameterName] = $parameter;
                } elseif ($parameter->in === Parameter::PATH) {
                    $requestMakeUrl->pathParameters[$parameterName] = $parameter;
                } elseif ($parameter->in === Parameter::HEADER) {
                    $requestMakeHeaders->headerParameters[$parameterName] = $parameter;
                } elseif ($parameter->in === Parameter::FORM_DATA) {
                    $requestMakeHeaders->bodyContentType = 'application/x-www-form-urlencoded';
                    $requestMakeBody->formDataParameters[$parameterName] = $parameter;
                } elseif ($parameter->in === Parameter::BODY) {
                    $requestMakeHeaders->bodyContentType = 'application/json; charset=utf-8';
                    if (!empty($handler->contentType)) {
                        $requestMakeHeaders->bodyContentType = $handler->contentType;
                    }
                    $requestMakeBody->bodyParameters[$parameterName] = $parameter;
                }

                if ($parameter->in === Parameter::BODY) {
                    if ($parameter->schema === null) {
                        throw new \Exception('Null schema for body parameter');
                    }
                } else {
                    if (!empty($parameter->required)) {
                        $requestSchema->required [] = $parameterName;
                    }
                    if ($parameter->isFile) {
                        // TODO implement file uploads.
                        Log::getInstance()->addAlert("Implement FILE handling");
                        throw new Exception('Not supported');
                    }
                }

                $desc = "In: $parameter->in, Name: $parameter->name";
                if (strpos($parameter->schema->description, $desc) === false) {
                    $parameter->schema->description .= ($parameter->schema->description ? "\n" : '') . $desc;
                }
                $requestSchema->properties->$parameterName = $parameter->schema;
            }

            if (!$requestSchema->required) {
                unset($requestSchema->required);
            }
        }

        $requestClass = $builder->getClass($requestSchema, 'request/' . $handler->method . ':' . $handler->path);
        $requestClass->setNamespace($namespace . '\Request');
        $requestClass->setName(PhpCode::makePhpName($handler->method . ':' . $handler->path . '_Request', false));

        $requestClass->addMethod($requestMakeUrl);
        $requestClass->addMethod($requestMakeHeaders);
        $requestClass->addMethod($requestMakeBody);
        return $requestClass;
    }


}