<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Place\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/PlaceEntity
 */
class PlaceEntity extends ClassStructure
{
    /** @var int */
    public $placeId;

    /** @var string */
    public $createdAt;

    /** @var int */
    public $foxId;

    /** @var string In: query, Name: foxUuid */
    public $foxUuid;

    /** @var int */
    public $fooId;

    /** @var string */
    public $barName;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->placeId = Schema::integer();
        $properties->createdAt = Schema::string();
        $properties->createdAt->format = "date-time";
        $properties->foxId = Schema::integer();
        $properties->foxId->minimum = 0;
        $properties->foxUuid = Schema::string();
        $properties->foxUuid->format = "uuid";
        $properties->foxUuid->setFromRef('#/components/schemas/UuidUUID');
        $properties->fooId = Schema::integer();
        $properties->barName = Schema::string();
        $properties->barName->setFromRef('#/components/schemas/FooBar');
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->foxUuid,
            self::names()->fooId,
            self::names()->barName,
        );
        $ownerSchema->setFromRef('#/components/schemas/PlaceEntity');
    }
}