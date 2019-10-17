<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\User\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetHistoryRequest extends ClassStructure
{
    /**
     * @var int Offset the list of returned results by this amount. Default is zero.
     * In: query, Name: offset
     */
    public $offset;

    /**
     * @var int Number of items to retrieve. Default is 5, maximum is 100.
     * In: query, Name: limit
     */
    public $limit;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->offset = Schema::integer();
        $properties->offset->format = "int32";
        $properties->limit = Schema::integer();
        $properties->limit->format = "int32";
        $ownerSchema->type = Schema::OBJECT;
    }

    public function makeUrl()
    {
        $url = '/history';
        $queryString = '';
        if (null !== $this->offset) {
            $queryString .= '&offset=' . $this->offset;
        }
        if (null !== $this->limit) {
            $queryString .= '&limit=' . $this->limit;
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