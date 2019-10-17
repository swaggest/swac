<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Search\Operation;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Swac\Example\UsptoOAS3\Config;
use Swac\Example\UsptoOAS3\Search\Request\PostRecordsRequest;
use Swac\Example\UsptoOAS3\Search\Response\PostDatasetVersionRecordsOKResponse;
use Swaggest\JsonSchema\Exception;
use Swaggest\JsonSchema\InvalidValue;
use Swaggest\RestClient\AbstractOperation;
use Swaggest\RestClient\Http\Method;
use Swaggest\RestClient\Http\StatusCode;
use Swaggest\RestClient\RestException;


/**
 * This API is based on Solr/Lucense Search. The data is indexed using SOLR.
 * This GET API returns the list of all the searchable field names that are in
 * the Solr Index. Please see the 'fields' attribute which returns an array of
 * field names. Each field or a combination of fields can be searched using
 * the Solr/Lucene Syntax. Please refer
 * https://lucene.apache.org/core/3_6_2/queryparsersyntax.html#Overview for
 * the query syntax. List of field names that are searchable can be determined
 * using above GET api.
 * HTTP: POST /{dataset}/{version}/records
 */
class PostRecords extends AbstractOperation
{
    /**
     * @param ClientInterface $client
     * @param PostRecordsRequest $request
     * @param Config $config
     * @throws InvalidValue
     * @throws RestException
     */
    public function __construct(ClientInterface $client, PostRecordsRequest $request, Config $config)
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
     * @return array[]|array
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
            case StatusCode::OK: $result = PostDatasetVersionRecordsOKResponse::import($this->getJsonResponse());break;
            case StatusCode::NOT_FOUND: $result = null;break;
            default: throw new RestException('Unsupported response status code: ' . $statusCode, RestException::UNSUPPORTED_RESPONSE_CODE);
        }
        return $result;
    }
}