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
use Swac\Example\FooBarOAS3\LieAreas\Definitions\LieAreaEntity;
use Swac\Example\FooBarOAS3\LieAreas\Request\PostLieAreasRequest;
use Swac\Example\FooBarOAS3\Place\Definitions\RestErrResponse;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * Create lie areas with postcodes.
 * HTTP: POST /lie-areas
 */
class PostLieAreas extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param PostLieAreasRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, PostLieAreasRequest $request, Config $config)
    {
        $this->client = $client;
        $request->validate();
        $this->rawRequest = new Request(
            Method::POST,
            rtrim($config->getBaseUrl(), '/') . $request->makeUrl(),
            $request->makeHeaders(),
            $request->makeBody()
        );
    }

    /**
     * @return LieAreaEntity|RestErrResponse
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
            case StatusCode::OK: $result = LieAreaEntity::import($this->getJsonResponse());break;
            case StatusCode::BAD_REQUEST: $result = RestErrResponse::import($this->getJsonResponse());break;
            case StatusCode::CONFLICT: $result = RestErrResponse::import($this->getJsonResponse());break;
            case StatusCode::INTERNAL_SERVER_ERROR: $result = RestErrResponse::import($this->getJsonResponse());break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}