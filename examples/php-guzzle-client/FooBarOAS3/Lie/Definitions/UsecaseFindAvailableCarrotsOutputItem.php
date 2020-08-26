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
 * Built from #/components/schemas/UsecaseFindAvailableCarrotsOutputItem
 */
class UsecaseFindAvailableCarrotsOutputItem extends ClassStructure
{
    /** @var int[]|array */
    public $carrots;

    /** @var string */
    public $error;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->carrots = Schema::arr();
        $properties->carrots->items = Schema::integer();
        $properties->error = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/UsecaseFindAvailableCarrotsOutputItem');
    }
}