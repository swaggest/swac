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
 * Built from #/components/schemas/FooLocalActivation
 * @property null|int $maxRoxesReceived
 * @property null|int $minRoxesReceived
 */
class FooLocalActivation extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->maxRoxesReceived = (new Schema())->setType([Schema::NULL, Schema::INTEGER]);
        $properties->minRoxesReceived = (new Schema())->setType([Schema::NULL, Schema::INTEGER]);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/FooLocalActivation');
    }
}