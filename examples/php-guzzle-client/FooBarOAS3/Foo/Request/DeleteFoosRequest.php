<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Foo\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class DeleteFoosRequest extends ClassStructure
{
    /** @var int In: query, Name: id */
    public $id;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->id = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->id,
        );
    }

    public function makeUrl()
    {
        $url = '/foos';
        $queryString = '';
        if (null !== $this->id) {
            $queryString .= '&id=' . $this->id;
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