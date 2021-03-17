<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Metadata\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\UsptoOAS3\Config;
use Swac\Example\UsptoOAS3\Metadata\Request\ListSearchableFieldsRequest;
use Swac\Example\UsptoOAS3\Metadata\Response\GetDatasetVersionFieldsNotFoundResponse;
use Swac\Example\UsptoOAS3\Metadata\Response\GetDatasetVersionFieldsOKResponse;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * This GET API returns the list of all the searchable field names that are in
 * the oa_citations. Please see the 'fields' attribute which returns an array
 * of field names. Each field or a combination of fields can be searched using
 * the syntax options shown below.
 * HTTP: GET /{dataset}/{version}/fields
 */
class ListSearchableFields extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param ListSearchableFieldsRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, ListSearchableFieldsRequest $request, Config $config)
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
     * @return string
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
            case StatusCode::OK: $result = GetDatasetVersionFieldsOKResponse::import($this->getJsonResponse());break;
            case StatusCode::NOT_FOUND: $result = GetDatasetVersionFieldsNotFoundResponse::import($this->getJsonResponse());break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}