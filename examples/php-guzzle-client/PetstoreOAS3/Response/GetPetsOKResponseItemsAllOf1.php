<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\PetstoreOAS3\Response;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetPetsOKResponseItemsAllOf1 extends ClassStructure
{
    /** @var int */
    public $id;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->id = Schema::integer();
        $properties->id->format = "int64";
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->id,
        );
    }
}