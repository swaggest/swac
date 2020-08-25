<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Foo\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/LiesPreference
 * @property int[]|null|array $other
 * @property int[]|null|array $recommended
 */
class LiesPreference extends ClassStructure
{
    /** @var string */
    public $preset;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->other = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->other->items = Schema::integer();
        $properties->preset = Schema::string();
        $properties->recommended = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->recommended->items = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesPreference');
    }
}