<?php

namespace Swac\Go\Client;

use Swac\Command\App;
use Swac\Go\LiteralType;
use Swac\Log;
use Swac\Rest\Config;
use Swac\Rest\Operation;
use Swac\Rest\Parameter;
use Swac\Rest\Renderer;
use Swac\Rest\Response;
use Swac\Skip;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\GoCodeBuilder\GoCodeBuilder;
use Swaggest\GoCodeBuilder\JsonSchema\GoBuilder;
use Swaggest\GoCodeBuilder\JsonSchema\MarshalingTestFunc;
use Swaggest\GoCodeBuilder\JsonSchema\StripPrefixPathToNameHook;
use Swaggest\GoCodeBuilder\JsonSchema\TypeBuilder;
use Swaggest\GoCodeBuilder\Templates\Code;
use Swaggest\GoCodeBuilder\Templates\Func\Argument;
use Swaggest\GoCodeBuilder\Templates\Func\Arguments;
use Swaggest\GoCodeBuilder\Templates\Func\FuncDef;
use Swaggest\GoCodeBuilder\Templates\Func\Result;
use Swaggest\GoCodeBuilder\Templates\GoFile;
use Swaggest\GoCodeBuilder\Templates\Imports;
use Swaggest\GoCodeBuilder\Templates\Struct\StructDef;
use Swaggest\GoCodeBuilder\Templates\Struct\StructProperty;
use Swaggest\GoCodeBuilder\Templates\Struct\StructType;
use Swaggest\GoCodeBuilder\Templates\Struct\Tags;
use Swaggest\GoCodeBuilder\Templates\Type\AnyType;
use Swaggest\GoCodeBuilder\Templates\Type\FuncType;
use Swaggest\GoCodeBuilder\Templates\Type\Map;
use Swaggest\GoCodeBuilder\Templates\Type\Pointer;
use Swaggest\GoCodeBuilder\Templates\Type\Slice;
use Swaggest\GoCodeBuilder\Templates\Type\TypeUtil;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\SwaggerHttp\StatusCode;
use Swaggest\SwaggerHttp\StatusCodes;

class Client implements Renderer
{
    /** @var Code */
    private $client;

    /** @var Code[] a map of operation-related code per operation name */
    private $operationsCode = [];

    /** @var Code definitions of value structures */
    private $models;

    /** @var StructDef */
    private $clientStruct;

    /** @var GoCodeBuilder */
    private $codeBuilder;

    /** @var GoBuilder */
    private $schemaBuilder;

    /** @var Config */
    private $config;

    /** @var Settings */
    private $settings;

    const PARAM_FIELD_NAME_META = 'goParamFieldName';

    public function __construct(Settings $settings = null)
    {
        if ($settings === null) {
            $settings = new Settings();
        }

        $this->settings = $settings;

        $this->client = new Code();
        $this->models = new Code();

        $this->clientStruct = new StructDef('Client');
        $this->clientStruct->addProperty(new StructProperty('BaseURL', TypeUtil::fromString('string')));
        $this->clientStruct->addProperty(new StructProperty('Timeout', TypeUtil::fromString('time.Duration')));

        $instrumentCtxFuncType = new Code();
        $instrumentCtxFuncType->addSnippet('func(ctx context.Context, method, pattern string, reqStruct interface{}) context.Context');
        $instrumentCtxFuncType->imports()->addByName('context');
        $instrumentCtxFuncProp = new StructProperty('InstrumentCtxFunc', new LiteralType($instrumentCtxFuncType));
        $instrumentCtxFuncProp->setComment(<<<'COMMENT'
InstrumentCtxFunc allows adding operation info to context.
A pointer to request structure passed into the function.
Nil value is ignored.
COMMENT
        );
        $this->clientStruct->addProperty($instrumentCtxFuncProp);

        $this->clientStruct->addProperty(new StructProperty('transport', TypeUtil::fromString('net/http.RoundTripper')));
        $this->codeBuilder = new GoCodeBuilder();

        $this->schemaBuilder = new GoBuilder();
        $this->schemaBuilder->options = $this->settings->builderOptions;
        if ($this->schemaBuilder->pathToNameHook instanceof StripPrefixPathToNameHook) {
            $this->schemaBuilder->pathToNameHook->prefixes [] = '#/components/schemas';
        }
        $this->schemaBuilder->options->enableXNullable = true;
    }

    public function setConfig(Config $config)
    {
        $this->config = $config;
        $clientComment = 'Client is a REST service HTTP client.';
        if (!empty($config->title)) {
            $clientComment .= "\n" . rtrim($config->title, '.') . '.';
        }
        if (!empty($config->description)) {
            $clientComment .= "\n" . rtrim($config->description, '.') . '.';
        }
        $this->clientStruct->setComment($clientComment);

        $constructor = new FuncDef('NewClient', 'NewClient creates client instance with default transport.');
        $constructor->setResult((new Result())->add(null, new Pointer($this->clientStruct->getType())));
        $constructorArgs = new Arguments();
        $constructor->setArguments($constructorArgs);
        $constructorBody = new Code();
        $constructorBody->addSnippet(<<<'GO'
return &Client{
	transport: http.DefaultTransport,
	Timeout:   30 * time.Second,

GO
        );
        if (!empty($config->baseUrl)) {
            $this->client->addSnippet(<<<GO
// DefaultBaseURL is the default base URL for this service.
const DefaultBaseURL = {$constructorBody->escapeValue($config->baseUrl)}


GO

            );
            $constructorBody->addSnippet(<<<GO
	BaseURL:   DefaultBaseURL,

GO
            );
        } else {
            $constructorArgs->add('baseURL', TypeUtil::fromString('string'));
            $constructorBody->imports()->addByName('strings');
            $constructorBody->addSnippet(<<<'GO'
    BaseURL: strings.TrimRight(baseURL, "/"),

GO
            );
        }
        $constructorBody->addSnippet(<<<'GO'
}
GO
        );
        $constructor->setBody($constructorBody);
        $this->clientStruct->addFunc($constructor);

        $roundTripperType = TypeUtil::fromString('net/http.RoundTripper');
        $transportSetter = new FuncDef('SetTransport', 'SetTransport sets client transport.');
        $transportSetter->setSelf(new Argument('c', new Pointer($this->clientStruct->getType())));
        $transportSetter->setArguments((new Arguments())->add('transport', $roundTripperType));
        $transportSetterBody = new Code(<<<'GO'
c.transport = transport

GO
        );
        $transportSetter->setBody($transportSetterBody);
        $this->clientStruct->addFunc($transportSetter);

        $roundTripperMiddleware = new FuncDef(null);
        $roundTripperMiddleware->setArguments((new Arguments())->add(null, $roundTripperType));
        $roundTripperMiddleware->setResult((new Result())->add(null, $roundTripperType));
        if (!empty($config->apiKeySecurityList)) {
            $this->client->addSnippet(<<<'GO'
type roundTripperFunc func(*http.Request) (*http.Response, error)

func (rt roundTripperFunc) RoundTrip(req *http.Request) (*http.Response, error) {
	return rt(req)
}


GO
            );
            foreach ($config->apiKeySecurityList as $security) {
                $securityName = $this->codeBuilder->privateName('security_' . $security->name);
                $this->clientStruct->addProperty(new StructProperty($securityName, new FuncType($roundTripperMiddleware)));
                $this->clientStruct->addProperty(new StructProperty($securityName . 'Transport', $roundTripperType));
                $transportSetterBody->addSnippet(<<<GO
if c.{$securityName} != nil {
	c.{$securityName}Transport = c.{$securityName}(c.transport)
}

GO
                );
                $securitySetterName = $this->codeBuilder->exportableName('set_security_' . $security->name . '_middleware');

                $securitySetter = new FuncDef($securitySetterName, $securitySetterName . ' sets security middleware.');
                $securitySetter->setSelf(new Argument('c', new Pointer($this->clientStruct->getType())));
                $securitySetter->setArguments((new Arguments())->add('middleware', new FuncType($roundTripperMiddleware)));
                $securitySetterBody = new Code(<<<GO
c.{$securityName} = middleware
if c.{$securityName} != nil {
	c.{$securityName}Transport = c.{$securityName}(c.transport)
} else {
	c.{$securityName}Transport = nil
}

GO
                );
                $securitySetter->setBody($securitySetterBody);

                if ($security->paramIn === Parameter::HEADER) {
                    $securityTokenSetterName = $this->codeBuilder->exportableName('set_security_' . $security->name . '_token');

                    $securityTokenSetter = new FuncDef($securityTokenSetterName, $securityTokenSetterName . ' sets security token.');
                    $securityTokenSetter->setSelf(new Argument('c', new Pointer($this->clientStruct->getType())));
                    $securityTokenSetter->setArguments((new Arguments())->add('token', TypeUtil::fromString('string')));
                    $securityTokenSetter->setBody(new Code(<<<GO
c.$securitySetterName(func(tripper http.RoundTripper) http.RoundTripper {
    return roundTripperFunc(func(req *http.Request) (*http.Response, error) {
        req.Header.Set({$securityTokenSetter->escapeValue($security->paramName)}, token)
        return tripper.RoundTrip(req)
    })
})

GO
                    ));

                    $this->clientStruct->addFunc($securityTokenSetter);
                }
                $this->clientStruct->addFunc($securitySetter);

            }
        }

        $this->client->addSnippet($this->clientStruct);
    }

    public function addOperation(Operation $operation)
    {
        if ($operation->operationId !== null && !isset($this->operationsCode[$this->codeBuilder->exportableName($operation->operationId)])) {
            $funcName = $this->codeBuilder->exportableName($operation->operationId);
            $underScoredName = strtolower(PhpCode::makePhpConstantName($operation->operationId));
        } else {
            $funcName = $this->codeBuilder->exportableName($operation->method . '_' . $operation->path);
            $underScoredName = strtolower(PhpCode::makePhpConstantName($operation->method . '_' . $operation->path));
        }

        $operationCode = new Code();

        $this->operationsCode[$underScoredName] = $operationCode;

        // Request.
        if (is_array($operation->parameters)) {
            foreach ($operation->parameters as $parameter) {
                if (!$parameter->required) {
                    $parameter->schema = clone $parameter->schema;
                    $parameter->schema->{TypeBuilder::NULLABLE} = true;
                }
            }
        }
        $requestStruct = $this->makeRequestStruct($funcName, $operation->parameters);


        $responseDecodeBody = $this->makeResp($operation->responses);
        $acceptJson = false;
        if (isset($responseDecodeBody->imports()->imports['encoding/json'])) {
            $acceptJson = true;
        }


        // TODO refactor away request setup.
        $requestEncode = new FuncDef('encode', 'encode creates *http.Request for request data.');
        $requestEncode->setSelf(new Argument('request', new Pointer($requestStruct->getType())));
        $requestEncode->setArguments(
            (new Arguments())
                ->add('ctx', TypeUtil::fromString('context.Context'))
                ->add('baseURL', TypeUtil::fromString('string'))
        );
        $requestEncode->setResult((new Result())
            ->add(null, TypeUtil::fromString('*net/http.Request'))
            ->add(null, TypeUtil::fromString('error'))
        );

        $requestEncode->setBody($this->makeReq($operation->method, $operation->path, $operation->parameters, $acceptJson,
            $operation->accept, $operation->contentType));
        $requestStruct->addFunc($requestEncode);

        $operationCode->addSnippet($requestStruct);


        // Response.
        $responseStruct = $this->makeResponseStruct($funcName, $operation->responses);
        $responseDecode = new FuncDef('decode', 'decode loads data from *http.Response.');
        $responseDecode->setSelf(new Argument('result', new Pointer($responseStruct->getType())));
        $responseDecode->setArguments(
            (new Arguments())
                ->add('resp', TypeUtil::fromString('*net/http.Response'))
        );
        $responseDecode->setResult((new Result())
            ->add(null, TypeUtil::fromString('error'))
        );
        $responseDecode->setBody($responseDecodeBody);
        $responseStruct->addFunc($responseDecode);

        $operationCode->addSnippet($responseStruct);


        $funcArgs = new Arguments();
        $funcArgs->add('ctx', TypeUtil::fromString('context.Context'));
        $funcArgs->add('request', $requestStruct->getType());


        $funcResult = new Result();
        $funcResult->add('result', $responseStruct->getType());
        $funcResult->add('err', TypeUtil::fromString('error'));


        $opFunc = new FuncDef($funcName, $funcName . ' performs REST operation.');
        $opFunc->setSelf(new Argument('c', new Pointer($this->clientStruct->getType())));
        $opFunc->setArguments($funcArgs);
        $opFunc->setResult($funcResult);
        $funcBody = new Code();

        $operationPathGoValue = $opFunc->escapeValue($operation->path);
        $operationUcfirstMethod = ucfirst($operation->method);

        $funcBody->addSnippet(new PlaceholderString(
            <<<GO
if c.InstrumentCtxFunc != nil {
	ctx = c.InstrumentCtxFunc(ctx, http.Method{$operationUcfirstMethod}, {$operationPathGoValue}, &request)
}

if c.Timeout != 0 {
	var cancel func()
	ctx, cancel = context.WithTimeout(ctx, c.Timeout)
	
	defer cancel()
}


GO
            ,
            [':result' => $responseStruct->getType()]
        ));

        $roundTripCall = <<<'GO'
resp, err := c.transport.RoundTrip(req)

GO;

        if (!empty($operation->security)) {
            $roundTripCall = <<<'GO'
transport := c.transport

GO;
            foreach ($operation->security as $item) {
                foreach ($item as $securityName => $scopes) {
                    $secTransport = $this->codeBuilder->privateName('security_' . $securityName . '_transport');
                    $roundTripCall .= <<<GO
if c.$secTransport != nil {
    transport = c.$secTransport
}


GO;

                }
            }
            $roundTripCall .= <<<'GO'
resp, err := transport.RoundTrip(req)
GO;

        }

        $funcBody->addSnippet(<<<GO
req, err := request.encode(ctx, c.BaseURL)
if err != nil {
    return result, err
}

$roundTripCall
if err != nil {
    return result, err
}

defer func() {
    closeErr := resp.Body.Close()
    if closeErr != nil && err == nil {
        err = closeErr
    }
}()

err = result.decode(resp)

return result, err

GO
        );

        $opFunc->setBody($funcBody);

        $operationCode->addSnippet($opFunc);
    }

    /**
     * @param string $funcName
     * @param Parameter[] $parameters
     * @return StructDef
     * @throws \Swaggest\GoCodeBuilder\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    private function makeRequestStruct($funcName, $parameters)
    {
        $requestStruct = new StructDef($funcName . 'Request', $funcName . 'Request is operation request value.');
        if (!is_array($parameters)) {
            Log::getInstance()->warn("No parameters for $funcName");
            return $requestStruct;
        }
        foreach ($parameters as $parameter) {
            $propName = $this->codeBuilder->exportableName($parameter->name);
            if (isset($requestStruct->getProperties()[$propName])) {
                $propName = $this->codeBuilder->exportableName($parameter->name . '/' . $parameter->in);
            }
            $basePropName = $propName;
            $i = 2;
            while (isset($requestStruct->getProperties()[$propName])) {
                $propName = $basePropName . $i;
                $i++;
            }

            $type = TypeUtil::fromString('interface{}');
            if ($parameter->schema !== null) {
                if ($parameter->schema->type === null) {
                    Log::getInstance()->warn("No type in parameter schema $parameter->name in $parameter->in for $funcName");
                }
                $paramPath = "$parameter->in/$parameter->name";
                if ($parameter->in === Parameter::BODY) {
                    $paramPath = Parameter::BODY;
                }
                $type = $this->getParamType($parameter->schema, "$funcName/request/$paramPath");
                if ($type instanceof StructType) {
                    $type = new Pointer($type);
                }
            } else {
                Log::getInstance()->warn("No parameter schema $parameter->name in $parameter->in for $funcName");
            }

            $comment = "$propName is " . ($parameter->required ? 'a required' : 'an optional')
                . " `$parameter->name` parameter in $parameter->in.\n";
            if ($parameter->in === Parameter::BODY) {
                $comment = "$propName is a JSON request body.\n";
            }
            if ($parameter->description) {
                $comment .= $parameter->description . "\n";
            }
            if ($parameter->deprecated) {
                $comment .= "Deprecated: don't use.\n";
            }

            $parameter->meta[self::PARAM_FIELD_NAME_META] = $propName;

            $paramTags = null;
            if ($this->settings->addRequestTags && $parameter->in !== Parameter::BODY) {
                $paramTags = new Tags();
                $paramTags->setTag($parameter->in, $parameter->name);
            }
            $paramProperty = new StructProperty($propName, $type, $paramTags);
            if (trim($comment)) {
                $paramProperty->setComment($comment);
            }
            $requestStruct->addProperty($paramProperty);
        }

        return $requestStruct;
    }

    private function responseStatusPropName(StatusCode $statusCode)
    {
        return $this->codeBuilder->exportableName('Value/' . $statusCode->phrase);
    }

    /**
     * @param string $funcName
     * @param Response[] $responses
     * @return StructDef
     * @throws \Swaggest\GoCodeBuilder\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    private function makeResponseStruct($funcName, $responses)
    {
        $responseStruct = new StructDef($funcName . 'Response', $funcName . 'Response is operation response value.');
        $responseStruct->addProperty(new StructProperty('StatusCode', TypeUtil::fromString('int')));
        $rawBody = new StructProperty('RawBody', TypeUtil::fromString('[]byte'));
        $rawBody->setComment('RawBody contains read bytes of response body.');
        $responseStruct->addProperty($rawBody);
        foreach ($responses as $response) {
            if ($response->isDefault) {
                $propName = 'Default';
                $comment = 'Default is a default value of response.';
            } else {
                $statusCode = StatusCodes::getInfoByCode((int)$response->statusCode);
                $propName = $this->responseStatusPropName($statusCode);
                $comment = $propName . ' is a value of ' . $response->statusCode . ' ' . $statusCode->phrase . ' response.';
            }

            $type = TypeUtil::fromString('interface{}');
            if ($response->schema !== null) {
                $type = $this->schemaBuilder->getType($response->schema, $funcName . '/response/' . $propName);
                if ($response->schema->type === null) {
                    Log::getInstance()->warn("No type in schema for $propName response at $funcName");
                }
            } else {
                if ($response->statusCode !== StatusCodes::NO_CONTENT) {
                    Log::getInstance()->warn("No response schema for $response->statusCode at $funcName");
                } else {
                    continue;
                }
            }

            if ($type instanceof StructType) {
                $type = new Pointer($type);
            }

            $property = new StructProperty(
                $propName,
                $type
            );
            $property->setComment($comment);

            $responseStruct->addProperty($property);
        }


        return $responseStruct;
    }

    private function toStringSliceExpression(Parameter $parameter, AnyType $type, $var, Imports $imports)
    {
        if ($parameter->collectionFormat !== Parameter::MULTI) {
            return false;
        }
        switch ($type->getTypeString()) {
            case '[]string':
                return $var;
            case '[]int':
            case '[]int64':
            case '[]float64':
            case '[]bool':
                $imports->addByName('strings');
                $imports->addByName('fmt');
                return <<<GO
strings.Fields(strings.Trim(fmt.Sprint($var), "[]"))
GO;
            default:
                return false;
        }
    }

    private function toStringExpression(Parameter $parameter, AnyType $type, $var, Imports $imports)
    {
        switch ($type->getTypeString()) {
//            case '*string':
//                return '*' . $var;
            case 'string':
                return $var;
            case 'bool':
                $imports->addByName('strconv');
                return "strconv.FormatBool($var)";
            case 'int64':
                $imports->addByName('strconv');
                return "strconv.FormatInt($var, 10)";
            case 'int':
                $imports->addByName('strconv');
                return "strconv.Itoa($var)";
            case 'float64':
                $imports->addByName('strconv');
                return "strconv.FormatFloat($var, 'g', -1, 64)";
            case '[]string':
                if ($parameter->collectionFormat === Parameter::MULTI) {
                    return false;
                } else {
                    $separator = self::$arraySeparators[$parameter->collectionFormat];
                    $imports->addByName('strings');
                    return "strings.Join($var, $separator)";
                }
            case '[]int':
            case '[]int64':
            case '[]float64':
            case '[]bool':
                if ($parameter->collectionFormat === Parameter::MULTI) {
                    return false;
                } else {
                    $separator = self::$arraySeparators[$parameter->collectionFormat];
                    $imports->addByName('strings');
                    $imports->addByName('fmt');
                    return <<<GO
strings.Join(strings.Fields(strings.Trim(fmt.Sprint($var), "[]")),$separator)
GO;
                }
            default:
                return false;
        }
    }

    private function buildHeaderParameters($parameters, Imports $imports)
    {
        $body = '';

        if ($parameters) {
            $body .= <<<GO

GO;

            foreach ($parameters as $name => $parameter) {
                $fieldName = $parameter->meta[self::PARAM_FIELD_NAME_META];
                $type = $this->getParamType($parameter->schema);
                $isPointer = false;
                $var = "request.$fieldName";
                if ($type instanceof Pointer) {
                    $isPointer = true;
                    $var = '*' . $var;
                    $type = $type->getType();
                }

                if ($type instanceof Slice || $type instanceof Map) {
                    $isPointer = true;
                }

                $toString = $this->toStringExpression($parameter, $type, $var, $imports);
                $assign = false;
                if ($toString !== false) {
                    $assign = <<<GO
req.Header.Set("$name", $toString)
GO;
                }
                if ($assign === false) {
                    throw new Skip("Could not stringify {$type->getTypeString()} of parameter `$parameter->name` in $parameter->in");
                }

                if ($assign !== false) {
                    if ($isPointer) {
                        $body .= <<<GO

if request.$fieldName != nil {
	$assign
}


GO;
                    } else {
                        $body .= <<<GO
$assign


GO;
                    }
                    continue;
                }

                throw new Skip("Could not stringify {$type->getTypeString()} of parameter `$parameter->name` in $parameter->in");
            }
        }

        return $body ? "\n\n" . $body : '';
    }

    /**
     * @param Parameter[] $parameters
     * @param Imports $imports
     * @param string $valuesVar
     * @return string
     * @throws Skip
     * @throws \Swaggest\GoCodeBuilder\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    private function buildUrlValues($parameters, Imports $imports, $valuesVar)
    {
        $body = '';

        if ($parameters) {
            $queryCount = count($parameters);
            $imports->addByName('net/url');
            $body .= <<<GO

$valuesVar := make(url.Values, $queryCount)

GO;

            foreach ($parameters as $name => $parameter) {
                $fieldName = $parameter->meta[self::PARAM_FIELD_NAME_META];
                $type = $this->getParamType($parameter->schema);

                $isPointer = false;
                $var = "request.$fieldName";
                if ($type instanceof Pointer) {
                    $isPointer = true;
                    $var = '*' . $var;
                    $type = $type->getType();
                }

                if ($type instanceof Slice || $type instanceof Map) {
                    $isPointer = true;
                }

                $toString = $this->toStringExpression($parameter, $type, $var, $imports);
                $assign = false;
                if ($toString !== false) {
                    $assign = <<<GO
$valuesVar.Set("$name", $toString)
GO;
                }
                if ($assign === false) {
                    $toStringSlice = $this->toStringSliceExpression($parameter, $type, $var, $imports);
                    if ($toStringSlice !== false) {
                        $assign = <<<GO
{$valuesVar}["$name"] = $toStringSlice
GO;
                    }
                }

                if ($assign !== false) {
                    if ($isPointer) {
                        $body .= <<<GO

if request.$fieldName != nil {
	$assign
}


GO;
                    } else {
                        $body .= <<<GO
$assign


GO;
                    }
                    continue;
                }

                throw new Skip("Could not stringify {$type->getTypeString()} of parameter `$parameter->name` in $parameter->in");
            }
        }

        return $body;
    }

    /**
     * @param string $method
     * @param string $path
     * @param Parameter[] $parameters
     * @param boolean $acceptJson
     * @param string $accept
     * @param string $contentType
     * @return string
     * @throws Exception
     * @throws Skip
     * @throws \Swaggest\GoCodeBuilder\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\Exception
     * @throws \Swaggest\JsonSchema\InvalidValue
     */
    protected function makeReq($method, $path, $parameters, $acceptJson, $accept, $contentType)
    {
        $result = new Code();

        /** @var Parameter[] $pathParameters */
        $pathParameters = [];
        /** @var Parameter[] $queryParameters */
        $queryParameters = [];
        /** @var Parameter[] $headerParameters */
        $headerParameters = [];
        /** @var Parameter[] $formDataParameters */
        $formDataParameters = [];
        /** @var Parameter[] $bodyParameters */
        $bodyParameters = [];
        if (is_array($parameters)) {
            foreach ($parameters as $parameter) {
                if ($parameter->in === Parameter::QUERY) {
                    $queryParameters[$parameter->name] = $parameter;
                } elseif ($parameter->in === Parameter::PATH) {
                    $pathParameters[$parameter->name] = $parameter;
                } elseif ($parameter->in === Parameter::FORM_DATA) {
                    $formDataParameters[$parameter->name] = $parameter;
                } elseif ($parameter->in === Parameter::BODY) {
                    $bodyParameters[$parameter->name] = $parameter;
                } elseif ($parameter->in === Parameter::HEADER) {
                    $headerParameters[$parameter->name] = $parameter;
                } else {
                    throw new Skip("Unsupported parameter location of parameter `$parameter->name`: $parameter->in");
                }
            }
        }

        $path = '"' . $path . '"';
        foreach ($pathParameters as $name => $parameter) {
            $fieldName = $parameter->meta[self::PARAM_FIELD_NAME_META];
            $var = "request.$fieldName";

            $type = $this->getParamType($parameter->schema);
            $value = $this->toStringExpression($parameter, $type, $var, $result->imports());
            if ($value === false) {
                throw new Exception('Could not stringify path parameter with type: ' . $type->getTypeString());
            }
            $path = str_replace('{' . $name . '}', "\" + url.PathEscape($value) + \"", $path);
            $result->imports()->addByName('net/url');
        }
        $path = str_replace(" + \"\"", '', $path);

        $body = <<<GO
requestURI := baseURL + $path


GO;

        if ($queryParameters) {
            $body .= $this->buildUrlValues($queryParameters, $result->imports(), 'query');
            $body .= <<<'GO'
if len(query) > 0 {
	requestURI += "?" + query.Encode()
}


GO;
        }

        $reqBody = 'nil';
        foreach ($bodyParameters as $name => $parameter) {
            $fieldName = $parameter->meta[self::PARAM_FIELD_NAME_META];
            $result->imports()->addByName('bytes');
            $result->imports()->addByName('encoding/json');

            $reqBody = 'bytes.NewBuffer(body)';
            if (empty($contentType)) {
                $contentType = 'application/json; charset=utf-8';
            }
            $body .= <<<GO
body, err := json.Marshal(request.$fieldName)
if err != nil {
    return nil, err
}

GO;

        }

        if (count($formDataParameters)) {
            $body .= $this->buildUrlValues($formDataParameters, $result->imports(), 'formData');
            $body .= <<<'GO'
var body io.Reader

if len(formData) > 0 {
	body = strings.NewReader(formData.Encode())
}


GO;
            $result->imports()
                ->addByName('strings')
                ->addByName('io');
            $reqBody = 'body';
            $contentType = 'application/x-www-form-urlencoded';
        }

        $method = ucfirst($method);

        if (!empty($contentType)) {
            $contentType = <<<GO
req.Header.Set("Content-Type", "$contentType")

GO;
        }
        $reqAccept = '';
        if ($acceptJson) {
            if (empty($accept)) {
                $accept = 'application/json';
            }

            $reqAccept = <<<GO
req.Header.Set("Accept", "$accept")

GO;

        }

        $body .= <<<GO

req, err := http.NewRequest(http.Method$method, requestURI, $reqBody)
if err != nil {
    return nil, err
}

{$contentType}{$reqAccept}{$this->buildHeaderParameters($headerParameters, $result->imports())}
req = req.WithContext(ctx)

return req, err
GO;

        $body .= <<<GO

GO;

        $result->imports()->addByName('net/http');


        $result->addSnippet($body);

        return $result;

    }

    /**
     * @param Response[] $responses
     * @return Code
     * @throws \Exception
     */
    public function makeResp($responses)
    {
        $code = new Code();

        $code->imports()
            ->addByName('io')
            ->addByName('bytes');

        $body = <<<'GO'
var err error

dump := bytes.NewBuffer(nil)
body := io.TeeReader(resp.Body, dump)

result.StatusCode = resp.StatusCode

switch resp.StatusCode {

GO;

        $hasDefault = false;
        foreach ($responses as $response) {
            if ($response->isDefault) {
                $hasDefault = true;
                continue;
            }
            $statusCode = StatusCodes::getInfoByCode($response->statusCode);
            $status = $this->codeBuilder->exportableName($statusCode->phrase);
            $propName = $this->responseStatusPropName($statusCode);

            if ($response->schema === null && $response->statusCode === StatusCodes::NO_CONTENT) {
                $body .= <<<GO
case http.Status$status:
    // No body to decode.

GO;
                continue;
            }

            $body .= <<<GO
case http.Status$status:
    err = json.NewDecoder(body).Decode(&result.$propName)

GO;
            $code->imports()->addByName('encoding/json');
        }

        if ($hasDefault) {
            $body .= <<<'GO'
default:
    err = json.NewDecoder(body).Decode(&result.Default)
}

GO;
            $code->imports()->addByName('encoding/json');
        } else {
            $body .= <<<'GO'
default:
    _, readErr := ioutil.ReadAll(body)
    if readErr != nil {
        err = errors.New("unexpected response status: " + resp.Status +
            ", could not read response body: " + readErr.Error())
    } else {
        err = errors.New("unexpected response status: " + resp.Status)
    }
}

GO;
            $code->imports()->addByName('errors')->addByName('io/ioutil');
        }

        $body .= <<<'GO'

result.RawBody = dump.Bytes()

if err != nil {
    return responseError{
        resp: resp,
        body: dump.Bytes(),
        err:  err,
    }
}

return nil

GO;


        $code->addSnippet($body);
        return $code;
    }

    private function responseError()
    {
        $c = new Code(<<<'GO'
type responseError struct {
	resp *http.Response
	body []byte
	err  error
}

func (re responseError) Unwrap() error {
	return re.err
}

func (re responseError) Error() string {
	return re.err.Error()
}

func (re responseError) ResponseBody() []byte {
	return re.body
}

func (re responseError) Response() *http.Response {
	return re.resp
}

GO
        );
        $c->imports()->addByName('net/http');
        return $c;
    }

    public function store($path, $packageName, $skipDoNotEdit = false)
    {
        $fileComment = 'Code generated by github.com/swaggest/swac ' . App::$ver . ', DO NOT EDIT.';
        if ($skipDoNotEdit) {
            $fileComment = '';
        }

        $file = new GoFile($packageName);
        $file->fileComment = $fileComment;
        $file->setCode($this->client);
        $file->setComment('Package ' . $packageName . ' contains autogenerated REST client.');

        file_put_contents($path . '/client.go', $file->render());

        $file = new GoFile($packageName);
        $file->fileComment = $fileComment;
        $file->setCode($this->responseError());

        file_put_contents($path . '/error.go', $file->render());

        foreach ($this->operationsCode as $funcName => $code) {
            $file = new GoFile($packageName);
            $file->fileComment = $fileComment;
            $file->getCode()->addSnippet($code);
            file_put_contents($path . "/$funcName.go", $file->render());
        }


        $file = new GoFile($packageName);
        $file->fileComment = $fileComment;

        $goTestFile = new GoFile($packageName . '_test');
        $goTestFile->setPackage($packageName);
        $goTestFile->fileComment = $fileComment;

        mt_srand(1);

        foreach ($this->schemaBuilder->getGeneratedStructs() as $generatedStruct) {
            $file->getCode()->addSnippet($generatedStruct->structDef);

            if ($this->settings->withTests) {
                $goTestFile->getCode()->addSnippet(MarshalingTestFunc::make($generatedStruct, $this->settings->builderOptions));
            }
        }

        $file->getCode()->addSnippet($this->schemaBuilder->getCode());
        file_put_contents($path . '/models.go', $file->render());

        if ($this->settings->withTests) {
            file_put_contents($path . '/models_test.go', $goTestFile->render());
        }
    }

    public static $arraySeparators = array(
        null => '","',
        Parameter::CSV => '","',
        Parameter::TSV => '"\t"',
        Parameter::SSV => '" "',
        Parameter::PIPES => '"|"',
    );

    /**
     * @param $schema
     */
    private function getParamType($schema, $path = '#')
    {
        $type = $this->schemaBuilder->getType($schema);
        if ($type instanceof Pointer) {
            if ($type->getType() instanceof Slice || $type->getType() instanceof Map) {
                $type = $type->getType();
            }
        }
        return $type;
    }

}