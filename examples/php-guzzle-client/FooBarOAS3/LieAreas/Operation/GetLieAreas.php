<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\LieAreas\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\FooBarOAS3\Config;
use Swac\Example\FooBarOAS3\LieAreas\Request\GetLieAreasRequest;
use Swac\Example\FooBarOAS3\LieAreas\Response\GetLieAreasOKResponse;
use Swac\Example\FooBarOAS3\Place\Definitions\RestErrResponse;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * List lie areas name by mille name
 * HTTP: GET /lie-areas
 */
class GetLieAreas extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param GetLieAreasRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, GetLieAreasRequest $request, Config $config)
    {
        $this->client = $client;
        $request->validate();
        $this->rawRequest = new Request(
            Method::GET,
            rtrim($config->getBaseUrl(), '/') . $request->makeUrl(),
            $request->makeHeaders(),
            $request->makeBody()
        );
    }

    /**
     * @return string[]|array|RestErrResponse
     * @throws RestException
     * @throws InvalidValue
     * @throws Exception
     * @throws GuzzleException
     */
    public function getResponse()
    {
        $raw = $this->getRawResponse();
        $statusCode = $raw->getStatusCode();
        switch ($statusCode) {
            case StatusCode::OK: $result = GetLieAreasOKResponse::import($this->getJsonResponse());break;
            case StatusCode::INTERNAL_SERVER_ERROR: $result = RestErrResponse::import($this->getJsonResponse());break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}