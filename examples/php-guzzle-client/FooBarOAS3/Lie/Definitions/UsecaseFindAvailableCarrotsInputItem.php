<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/UsecaseFindAvailableCarrotsInputItem
 */
class UsecaseFindAvailableCarrotsInputItem extends ClassStructure
{
    /** @var int */
    public $foxId;

    /** @var string In: query, Name: foxUuid */
    public $foxUuid;

    /** @var string */
    public $potatoFamily;

    /** @var int */
    public $holeId;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->foxId = Schema::integer();
        $properties->foxUuid = Schema::string();
        $properties->foxUuid->format = "uuid";
        $properties->foxUuid->setFromRef('#/components/schemas/UuidUUID');
        $properties->potatoFamily = Schema::string();
        $properties->potatoFamily->setFromRef('#/components/schemas/PotatosSoupFamily');
        $properties->holeId = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->holeId,
        );
        $ownerSchema->setFromRef('#/components/schemas/UsecaseFindAvailableCarrotsInputItem');
    }
}