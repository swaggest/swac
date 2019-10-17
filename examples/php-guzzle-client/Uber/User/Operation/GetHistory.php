<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\User\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\Uber\Config;
use Swac\Example\Uber\Products\Definitions\Error;
use Swac\Example\Uber\User\Definitions\Activities;
use Swac\Example\Uber\User\Request\GetHistoryRequest;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * The User Activity endpoint returns data about a user's lifetime activity
 * with Uber. The response will include pickup locations and times, dropoff
 * locations and times, the distance of past requests, and information about
 * which products were requested.<br><br>The history array in the response
 * will have a maximum length based on the limit parameter. The response value
 * count may exceed limit, therefore subsequent API requests may be necessary.
 * HTTP: GET /history
 */
class GetHistory extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param GetHistoryRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, GetHistoryRequest $request, Config $config)
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
     * @return Activities|Error
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
            case StatusCode::OK: $result = Activities::import($this->getJsonResponse());break;
            default: $result = Error::import($this->getJsonResponse());break;
        }
        return $result;
    }
}