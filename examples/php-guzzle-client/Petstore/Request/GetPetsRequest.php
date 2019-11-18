<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Petstore\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetPetsRequest extends ClassStructure
{
    /**
     * @var string[]|array tags to filter by
     * In: query, Name: tags
     */
    public $tags;

    /**
     * @var int maximum number of results to return
     * In: query, Name: limit
     */
    public $limit;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->tags = Schema::arr();
        $properties->tags->items = Schema::string();
        $properties->limit = Schema::integer();
        $properties->limit->format = "int32";
        $ownerSchema->type = Schema::OBJECT;
    }

    public function makeUrl()
    {
        $url = '/pets';
        $queryString = '';
        if (!empty($this->tags)) {
            $queryString .= '&tags=' . urlencode(implode(',', $this->tags));
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
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        return null;
    }
}