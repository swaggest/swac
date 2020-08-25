<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\LieAreas\Request;

use Swac\Example\FooBarOAS3\LieAreas\Definitions\LieareaValue;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class PostLieAreasRequest extends ClassStructure
{
    /** @var LieareaValue In: body, Name: body */
    public $body;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->body = LieareaValue::schema();
        $ownerSchema->type = Schema::OBJECT;
    }

    public function makeUrl()
    {
        $url = '/lie-areas';
        return $url;
    }

    public function makeHeaders()
    {
        $headers = array();
        $headers['Content-Type'] = 'application/json; charset=utf-8';
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        return json_encode($this->body);
    }
}