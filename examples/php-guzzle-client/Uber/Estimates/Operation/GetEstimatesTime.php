<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Estimates\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\Uber\Config;
use Swac\Example\Uber\Estimates\Request\GetEstimatesTimeRequest;
use Swac\Example\Uber\Estimates\Response\GetEstimatesTimeOKResponse;
use Swac\Example\Uber\Products\Definitions\Error;
use Swac\Example\Uber\Products\Definitions\Product;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * The Time Estimates endpoint returns ETAs for all products offered at a
 * given location, with the responses expressed as integers in seconds. We
 * recommend that this endpoint be called every minute to provide the most
 * accurate, up-to-date ETAs.
 * HTTP: GET /estimates/time
 */
class GetEstimatesTime extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param GetEstimatesTimeRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, GetEstimatesTimeRequest $request, Config $config)
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
     * @return Product[]|array|Error
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
            case StatusCode::OK: $result = GetEstimatesTimeOKResponse::import($this->getJsonResponse());break;
            default: $result = Error::import($this->getJsonResponse());break;
        }
        return $result;
    }
}