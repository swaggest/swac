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
 * Built from #/components/schemas/LiesPage
 * @property LiesLie[]|null|array $items
 */
class LiesPage extends ClassStructure
{
    /** @var int */
    public $count;

    /** @var int */
    public $skip;

    /** @var int */
    public $take;

    /** @var int */
    public $total;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->count = Schema::integer();
        $properties->items = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->items->items = LiesLie::schema();
        $properties->skip = Schema::integer();
        $properties->take = Schema::integer();
        $properties->total = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesPage');
    }
}