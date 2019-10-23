<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\PetstoreOAS3\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\PetstoreOAS3\Config;
use Swac\Example\PetstoreOAS3\Definitions\NewPet;
use Swac\Example\PetstoreOAS3\Definitions\Pet;
use Swac\Example\PetstoreOAS3\Request\GetPetsIdRequest;
use Swac\Example\PetstoreOAS3\Response\GetPetsOKResponseItemsAllOf1;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * Returns a user based on a single ID, if the user does not have access to
 * the pet
 * HTTP: GET /pets/{id}
 */
class GetPetsId extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param GetPetsIdRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, GetPetsIdRequest $request, Config $config)
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
     * @return NewPet|GetPetsOKResponseItemsAllOf1
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
            case StatusCode::OK: $result = Pet::import($this->getJsonResponse());break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}