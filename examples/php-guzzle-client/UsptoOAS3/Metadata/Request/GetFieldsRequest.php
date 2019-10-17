<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Metadata\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetFieldsRequest extends ClassStructure
{
    /** @var string In: path, Name: dataset */
    public $dataset;

    /** @var string In: path, Name: version */
    public $version;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->dataset = Schema::string();
        $properties->version = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->dataset,
            self::names()->version,
        );
    }

    public function makeUrl()
    {
        $url = '/' . urlencode($this->dataset) . '/' . urlencode($this->version) . '/fields';
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