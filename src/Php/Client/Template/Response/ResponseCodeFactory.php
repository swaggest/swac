<?php

namespace Swac\Php\Client\Template\Response;


use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Swac\Log;
use Swac\Rest\Response;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpStdType;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;
use Swaggest\SwaggerHttp\StatusCodes;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\Types\OrType;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class ResponseCodeFactory
{
    /** @var Response[] */
    private $responses;

    /** @var PhpCode */
    private $code;

    /** @var OrType */
    private $result;

    /** @var PhpBuilder */
    private $builder;

    /** @var string */
    private $handlerPath;

    /** @var PhpFunction */
    private $getResponseFunc;

    /** @var PhpFunction */
    private $getResponseHeadersFunc;

    /** @var PhpFunction */
    private $getResponseStatusFunc;

    /** @var Info[] */
    private $resultInfo;

    public function setBuilder(PhpBuilder $builder)
    {
        $this->builder = $builder;
        return $this;
    }

    /**
     * @param string $handlerPath
     * @return ResponseCodeFactory
     */
    public function setHandlerPath($handlerPath)
    {
        $this->handlerPath = $handlerPath;
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
        $this->code = new PhpCode();
        $this->result = new OrType();

        $body = new PhpCode();
        $body->addSnippet(<<<'PHP'
$raw = $this->getRawResponse();
$statusCode = $raw->getStatusCode();
switch ($statusCode) {

PHP
        );

        $this->getResponseStatusFunc = new PhpFunction('getResponseStatus', PhpFlags::VIS_PUBLIC);

        $this->getResponseFunc = new PhpFunction('getResponse', PhpFlags::VIS_PUBLIC);
        $this->getResponseFunc
            ->addThrows(PhpClass::byFQN(RestException::class))
            ->addThrows(PhpClass::byFQN(InvalidValue::class))
            ->addThrows(PhpClass::byFQN(\Swaggest\JsonSchema\Exception::class))
            ->addThrows(PhpClass::byFQN(GuzzleException::class));

        $this->getResponseHeadersFunc = new PhpFunction('getResponseHeaders', PhpFlags::VIS_PUBLIC);
        $headersBody = new PhpCode();
        $headersBody->addSnippet(<<<'PHP'
$raw = $this->getRawResponse();
$statusCode = $raw->getStatusCode();
switch ($statusCode) {

PHP
        );

        $result = new OrType();
        $headersResult = new OrType();
        $hasHeadersResponse = false;

        $hasDefaultResponse = false;
        if ($this->responses) {
            foreach ($this->responses as $response) {
                unset($binds);
                $binds = [];

                $resultInfo = new Info();
                $resultInfo->statusCode = $response->statusCode;
                $resultInfo->response = $response;

                $case = '    case ' . $response->statusCode;
                $codeName = $response->statusCode;
                if ($response->isDefault) {
                    $case = '    default';
                    $hasDefaultResponse = true;
                } else {
                    try {
                        $statusCode = StatusCodes::getInfoByCode((int)$response->statusCode);
                        $resultInfo->statusPhrase = $statusCode->phrase;

                        $case = '    case :statusCode::' . PhpCode::makePhpConstantName($statusCode->phrase);
                        $binds[':statusCode'] = new TypeOf(PhpClass::byFQN(StatusCode::class));
                        $codeName = $statusCode->phrase;
                    } catch (Exception $e) {

                    }
                }

                $path = 'response/' . $this->handlerPath . '/' . $codeName . '/response';

                if ($response->schema) {
                    try {
                        $class = $this->builder->getClass($response->schema, $path);
                        $type = $this->builder->getType($response->schema, $path);
                        $resultInfo->type = $class;

                        $result->add($type);

                        $binds[':type'] = new TypeOf($class);
                        $body->addSnippet(new PlaceholderString(
                            $case . ': $result = :type::import($this->getJsonResponse());break;' . "\n", $binds
                        ));
                    } catch (Exception $e) {
                        Log::getInstance()->error($e->getMessage());
                    }
                } else {
                    $body->addSnippet(new PlaceholderString(
                        $case . ': $result = null;break;' . "\n", $binds
                    ));
                }

                if ($response->headers) {
                    $hasHeadersResponse = true;
                    $headersSchema = Schema::object();
                    $headersRead = new HeadersReadFuncBuilder();

                    foreach ($response->headers as $name => $headerSchema) {
                        $headersSchema->setProperty($name, $headerSchema);
                        $headersRead->addHeader($name, $headerSchema);
                    }
                    $headersClass = $this->builder->getClass($headersSchema, $path . '/headers');
                    $headersType = $this->builder->getType($headersSchema, $path . '/headers');
                    $headersClass->addMethod($headersRead->build());

                    $headersResult->add($headersType);
                    $headersBody->addSnippet(new PlaceholderString(
                        $case . ': $result = :type::read($raw);break;' . "\n",
                        [':type' => new TypeOf($headersClass)]
                    ));
                } else {
                    $headersBody->addSnippet(
                        $case . ': $result = null;break;' . "\n"
                    );
                }

                $this->resultInfo[] = $resultInfo;
            }
        }

        if (!$hasDefaultResponse) {
            $body->addSnippet(new PlaceholderString(<<<'PHP'
    default: throw new :exception('Unsupported response status code: ' . $statusCode, :exception::UNSUPPORTED_RESPONSE_CODE);

PHP
                , [':exception' => new TypeOf(PhpClass::byFQN(RestException::class))]));

            $headersBody->addSnippet(new PlaceholderString(<<<'PHP'
    default: throw new :exception('Unsupported response status code: ' . $statusCode, :exception::UNSUPPORTED_RESPONSE_CODE);

PHP
                , [':exception' => new TypeOf(PhpClass::byFQN(RestException::class))]));

        }

        $body->addSnippet(<<<'PHP'
}
return $result;

PHP
        );

        $headersBody->addSnippet(<<<'PHP'
}
return $result;

PHP
        );

        $this->getResponseFunc->setResult($result);
        $this->getResponseFunc->setBody($body);


        if (!$hasHeadersResponse) {
            $this->getResponseHeadersFunc = null;
        } else {
            $this->getResponseHeadersFunc
                ->addThrows(PhpClass::byFQN(RestException::class))
                ->addThrows(PhpClass::byFQN(GuzzleException::class));

            $this->getResponseHeadersFunc->setResult($headersResult);
            $this->getResponseHeadersFunc->setBody($headersBody);
        }
    }

    public function getResponseFunc()
    {
        return $this->getResponseFunc;
    }

    public function getResponseHeadersFunc()
    {
        return $this->getResponseHeadersFunc;
    }

    /**
     * @return PhpFunction
     * @deprecated
     */
    public function getResponseStatusFunc()
    {
        $this->getResponseStatusFunc->setResult(PhpStdType::int());
        $this->getResponseStatusFunc->setThrows(PhpClass::byFQN(GuzzleException::class));
        $this->getResponseStatusFunc->setBody(<<<'PHP'
return $this->getRawResponse()->getStatusCode();
PHP
        );
        return $this->getResponseStatusFunc;
    }

    /**
     * @return Info[]
     */
    public function getResultInfo()
    {
        return $this->resultInfo;
    }
}