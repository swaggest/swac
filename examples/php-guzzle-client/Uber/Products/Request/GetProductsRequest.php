<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Products\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetProductsRequest extends ClassStructure
{
    /**
     * @var float Latitude component of location.
     * In: query, Name: latitude
     */
    public $latitude;

    /**
     * @var float Longitude component of location.
     * In: query, Name: longitude
     */
    public $longitude;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->latitude = Schema::number();
        $properties->latitude->format = "double";
        $properties->longitude = Schema::number();
        $properties->longitude->format = "double";
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->latitude,
            self::names()->longitude,
        );
    }

    public function makeUrl()
    {
        $url = '/products';
        $queryString = '';
        if (null !== $this->latitude) {
            $queryString .= '&latitude=' . $this->latitude;
        }
        if (null !== $this->longitude) {
            $queryString .= '&longitude=' . $this->longitude;
        }
        if ('' !== $queryString) {
            $queryString[0] = '?';
            $url .= $queryString;
        }
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