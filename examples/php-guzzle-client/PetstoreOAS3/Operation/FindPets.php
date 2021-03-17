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
use Swac\Example\PetstoreOAS3\Request\FindPetsRequest;
use Swac\Example\PetstoreOAS3\Response\GetPetsOKResponse;
use Swac\Example\PetstoreOAS3\Response\GetPetsOKResponseItemsAllOf1;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * Returns all pets from the system that the user has access to
 * Nam sed condimentum est. Maecenas tempor sagittis sapien, nec rhoncus sem
 * sagittis sit amet. Aenean at gravida augue, ac iaculis sem. Curabitur odio
 * lorem, ornare eget elementum nec, cursus id lectus. Duis mi turpis,
 * pulvinar ac eros ac, tincidunt varius justo. In hac habitasse platea
 * dictumst. Integer at adipiscing ante, a sagittis ligula. Aenean pharetra
 * tempor ante molestie imperdiet. Vivamus id aliquam diam. Cras quis velit
 * non tortor eleifend sagittis. Praesent at enim pharetra urna volutpat
 * venenatis eget eget mauris. In eleifend fermentum facilisis. Praesent enim
 * enim, gravida ac sodales sed, placerat id erat. Suspendisse lacus dolor,
 * consectetur non augue vel, vehicula interdum libero. Morbi euismod sagittis
 * libero sed lacinia.
 * 
 * Sed tempus felis lobortis leo pulvinar rutrum. Nam mattis velit nisl, eu
 * condimentum ligula luctus nec. Phasellus semper velit eget aliquet
 * faucibus. In a mattis elit. Phasellus vel urna viverra, condimentum lorem
 * id, rhoncus nibh. Ut pellentesque posuere elementum. Sed a varius odio.
 * Morbi rhoncus ligula libero, vel eleifend nunc tristique vitae. Fusce et
 * sem dui. Aenean nec scelerisque tortor. Fusce malesuada accumsan magna vel
 * tempus. Quisque mollis felis eu dolor tristique, sit amet auctor felis
 * gravida. Sed libero lorem, molestie sed nisl in, accumsan tempor nisi.
 * Fusce sollicitudin massa ut lacinia mattis. Sed vel eleifend lorem.
 * Pellentesque vitae felis pretium, pulvinar elit eu, euismod sapien.
 * HTTP: GET /pets
 */
class FindPets extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param FindPetsRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, FindPetsRequest $request, Config $config)
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
     * @return NewPet[]|GetPetsOKResponseItemsAllOf1[]|array
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
            case StatusCode::OK: $result = GetPetsOKResponse::import($this->getJsonResponse());break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}