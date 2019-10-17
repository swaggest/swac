<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Metadata\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class DataSetListApisItems extends ClassStructure
{
    /** @var string To be used as a dataset parameter value */
    public $apiKey;

    /** @var string To be used as a version parameter value */
    public $apiVersionNumber;

    /** @var string The URL describing the dataset's fields */
    public $apiUrl;

    /** @var string A URL to the API console for each API */
    public $apiDocumentationUrl;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->apiKey = Schema::string();
        $properties->apiVersionNumber = Schema::string();
        $properties->apiUrl = Schema::string();
        $properties->apiUrl->format = "uriref";
        $properties->apiDocumentationUrl = Schema::string();
        $properties->apiDocumentationUrl->format = "uriref";
        $ownerSchema->type = Schema::OBJECT;
    }
}