<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Search\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class PostRecordsRequest extends ClassStructure
{
    /** @var string In: path, Name: version */
    public $version;

    /** @var string In: path, Name: dataset */
    public $dataset;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->version = Schema::string();
        $properties->version->default = "v1";
        $properties->dataset = Schema::string();
        $properties->dataset->default = "oa_citations";
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->version,
            self::names()->dataset,
        );
    }

    public function makeUrl()
    {
        $url = '/' . urlencode($this->dataset) . '/' . urlencode($this->version) . '/records';
        return $url;
    }

    public function makeHeaders()
    {
        $headers = array();
        return $headers;
    }

    public function makeBody()
    {
        return null;
    }
}