<?php

namespace Swac\Php\Client\Template\Handler;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use Swac\Php\Client\Template\ConfigClass;
use Swac\Php\Client\Template\OperationClass;
use Swac\Php\Client\Template\Security\ApplySecurity;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpClassProperty;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\Types\TypeOf;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\RestException;

class Constructor
{
    /**
     * @param PhpAnyType $requestType
     * @param ConfigClass $configClass
     * @param string $httpMethodUppercased
     * @param [][]string $security
     * @return PhpFunction
     */
    public static function make(PhpAnyType $requestType, ConfigClass $configClass, $httpMethodUppercased, $security)
    {
        return (new PhpFunction('__construct', PhpFlags::VIS_PUBLIC))
            ->addArgument(new PhpNamedVar('client', PhpClass::byFQN(ClientInterface::class)))
            ->addArgument(new PhpNamedVar('request', $requestType))
            ->addArgument(new PhpNamedVar('config', $configClass))
            ->addThrows(PhpClass::byFQN(InvalidValue::class))
            ->addThrows(PhpClass::byFQN(RestException::class))
            ->setBody(new PlaceholderString(
                <<<PHP
\$this->client = \$client;
\$request->validate();
\$this->rawRequest = new :guzzleRequest(
    :method::{$httpMethodUppercased},
    rtrim(\$config->getBaseUrl(), '/') . \$request->makeUrl(),
    \$request->makeHeaders(),
    \$request->makeBody()
);
:applySecurity

PHP
                , [
                ':method' => new TypeOf(PhpClass::byFQN(Method::class)),
                ':guzzleRequest' => new TypeOf(PhpClass::byFQN(Request::class)),
                ':applySecurity' => new ApplySecurity($configClass, $security),
            ]));
    }

}