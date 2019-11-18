<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Estimates\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetEstimatesPriceRequest extends ClassStructure
{
    /**
     * @var float Latitude component of start location.
     * In: query, Name: start_latitude
     */
    public $startLatitude;

    /**
     * @var float Longitude component of start location.
     * In: query, Name: start_longitude
     */
    public $startLongitude;

    /**
     * @var float Latitude component of end location.
     * In: query, Name: end_latitude
     */
    public $endLatitude;

    /**
     * @var float Longitude component of end location.
     * In: query, Name: end_longitude
     */
    public $endLongitude;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->startLatitude = Schema::number();
        $properties->startLatitude->format = "double";
        $ownerSchema->addPropertyMapping('start_latitude', self::names()->startLatitude);
        $properties->startLongitude = Schema::number();
        $properties->startLongitude->format = "double";
        $ownerSchema->addPropertyMapping('start_longitude', self::names()->startLongitude);
        $properties->endLatitude = Schema::number();
        $properties->endLatitude->format = "double";
        $ownerSchema->addPropertyMapping('end_latitude', self::names()->endLatitude);
        $properties->endLongitude = Schema::number();
        $properties->endLongitude->format = "double";
        $ownerSchema->addPropertyMapping('end_longitude', self::names()->endLongitude);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            'start_latitude',
            'start_longitude',
            'end_latitude',
            'end_longitude',
        );
    }

    public function makeUrl()
    {
        $url = '/estimates/price';
        $queryString = '';
        if (null !== $this->startLatitude) {
            $queryString .= '&start_latitude=' . $this->startLatitude;
        }
        if (null !== $this->startLongitude) {
            $queryString .= '&start_longitude=' . $this->startLongitude;
        }
        if (null !== $this->endLatitude) {
            $queryString .= '&end_latitude=' . $this->endLatitude;
        }
        if (null !== $this->endLongitude) {
            $queryString .= '&end_longitude=' . $this->endLongitude;
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
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        return null;
    }
}