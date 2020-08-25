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
 * In: body, Name: body
 * Built from #/components/schemas/UsecaseFindAvailableCarrotsInput
 */
class UsecaseFindAvailableCarrotsInput extends ClassStructure
{
    /** @var UsecaseFindAvailableCarrotsInputItem[] */
    public $items;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->items = Schema::object();
        $properties->items->additionalProperties = UsecaseFindAvailableCarrotsInputItem::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->items,
        );
        $ownerSchema->setFromRef('#/components/schemas/UsecaseFindAvailableCarrotsInput');
    }
}