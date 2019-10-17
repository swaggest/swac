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
use Swac\Example\Uber\Estimates\Definitions\PriceEstimate;
use Swac\Example\Uber\Estimates\Request\GetEstimatesPriceRequest;
use Swac\Example\Uber\Estimates\Response\GetEstimatesPriceOKResponse;
use Swac\Example\Uber\Products\Definitions\Error;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * The Price Estimates endpoint returns an estimated price range for each
 * product offered at a given location. The price estimate is provided as a
 * formatted string with the full price range and the localized currency
 * symbol.<br><br>The response also includes low and high estimates, and the
 * [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code for
 * situations requiring currency conversion. When surge is active for a
 * particular product, its surge_multiplier will be greater than 1, but the
 * price estimate already factors in this multiplier.
 * HTTP: GET /estimates/price
 */
class GetEstimatesPrice extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param GetEstimatesPriceRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, GetEstimatesPriceRequest $request, Config $config)
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
     * @return PriceEstimate[]|array|Error
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
            case StatusCode::OK: $result = GetEstimatesPriceOKResponse::import($this->getJsonResponse());break;
            default: $result = Error::import($this->getJsonResponse());break;
        }
        return $result;
    }
}