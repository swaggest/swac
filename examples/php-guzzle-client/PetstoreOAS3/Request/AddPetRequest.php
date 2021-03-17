<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\PetstoreOAS3\Request;

use Swac\Example\PetstoreOAS3\Definitions\NewPet;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class AddPetRequest extends ClassStructure
{
    /** @var NewPet In: body, Name: body */
    public $body;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->body = NewPet::schema();
        $ownerSchema->type = Schema::OBJECT;
    }

    public function makeUrl()
    {
        $url = '/pets';
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