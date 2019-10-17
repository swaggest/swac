<?php

namespace Swac\Php\Client\Template;

use Swac\Rest\Operation;
use Swac\Rest\Response;
use Swac\Php\Client\Template\Handler\Constructor;
use Swac\Php\Client\Template\Response\ResponseCodeFactory;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;


class OperationClass extends PhpClass
{
    /** @var Operation */
    private $operation;

    /** @var PhpAnyType */
    private $requestType;

    /**
     * @return PhpAnyType
     */
    public function getRequestType()
    {
        return $this->requestType;
    }

    /** @var Response[] */
    private $responses;

    /** @var ResponseCodeFactory */
    private $responseCodeFactory;

    /** @var PhpBuilder */
    private $builder;

    /** @var ConfigClass */
    private $configClass;

    public function __construct(Operation $operation, PhpBuilder $builder, ConfigClass $configClass)
    {
        $this->operation = $operation;
        $this->builder = $builder;
        $this->responseCodeFactory = new ResponseCodeFactory();
        $this->responseCodeFactory->setBuilder($this->builder);
        $this->responseCodeFactory->setHandlerPath($operation->method . ':' . $operation->path);
        $this->configClass = $configClass;
    }

    /**
     * @param PhpAnyType $requestType
     * @return $this
     */
    public function setRequestType($requestType)
    {
        $this->requestType = $requestType;
        return $this;
    }

    /**
     * @param Response[] $responses
     * @return $this
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
        return $this;
    }

    /**
     * @throws \Swaggest\PhpCodeBuilder\Exception
     * @throws \Swaggest\PhpCodeBuilder\JsonSchema\Exception
     */
    public function build()
    {
        $this->setExtends(PhpClass::byFQN(AbstractOperation::class));

        $this->addMethod(Constructor::make(
            $this->requestType,
            $this->configClass,
            $this->operation->getMethodUppercase(),
            $this->operation->security
        ));

        $this->responseCodeFactory->setResponses($this->responses);
        $this->responseCodeFactory->build();

        $this->addMethod($this->responseCodeFactory->getResponseFunc());
        if (null !== $this->responseCodeFactory->getResponseHeadersFunc()) {
            $this->addMethod($this->responseCodeFactory->getResponseHeadersFunc());
        }
    }

    /**
     * @return Operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @return ResponseCodeFactory
     */
    public function getResponseCodeFactory()
    {
        return $this->responseCodeFactory;
    }

}