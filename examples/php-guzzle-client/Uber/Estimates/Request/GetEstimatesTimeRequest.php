<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Estimates\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetEstimatesTimeRequest extends ClassStructure
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
     * @var string Unique customer identifier to be used for experience customization.
     * In: query, Name: customer_uuid
     */
    public $customerUuid;

    /**
     * @var string Unique identifier representing a specific product for a given latitude & longitude.
     * In: query, Name: product_id
     */
    public $productId;

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
        $properties->customerUuid = Schema::string();
        $properties->customerUuid->format = "uuid";
        $ownerSchema->addPropertyMapping('customer_uuid', self::names()->customerUuid);
        $properties->productId = Schema::string();
        $ownerSchema->addPropertyMapping('product_id', self::names()->productId);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            'start_latitude',
            'start_longitude',
        );
    }

    public function makeUrl()
    {
        $url = '/estimates/time';
        $queryString = '';
        if (null !== $this->startLatitude) {
            $queryString .= '&start_latitude=' . $this->startLatitude;
        }
        if (null !== $this->startLongitude) {
            $queryString .= '&start_longitude=' . $this->startLongitude;
        }
        if (null !== $this->customerUuid) {
            $queryString .= '&customer_uuid=' . urlencode($this->customerUuid);
        }
        if (null !== $this->productId) {
            $queryString .= '&product_id=' . urlencode($this->productId);
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