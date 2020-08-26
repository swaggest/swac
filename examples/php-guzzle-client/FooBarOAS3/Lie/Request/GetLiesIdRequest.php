<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetLiesIdRequest extends ClassStructure
{
    /** @var string In: query, Name: locale */
    public $locale;

    /** @var int In: query, Name: hole */
    public $hole;

    /** @var string In: path, Name: id */
    public $id;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->locale = Schema::string();
        $properties->hole = Schema::integer();
        $properties->id = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->id,
        );
    }

    public function makeUrl()
    {
        $url = '/lies/' . urlencode($this->id);
        $queryString = '';
        if (null !== $this->locale) {
            $queryString .= '&locale=' . urlencode($this->locale);
        }
        if (null !== $this->hole) {
            $queryString .= '&hole=' . $this->hole;
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