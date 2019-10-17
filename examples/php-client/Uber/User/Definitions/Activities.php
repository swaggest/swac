<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\User\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Activities
 */
class Activities extends ClassStructure
{
    /** @var int Position in pagination. */
    public $offset;

    /** @var int Number of items to retrieve (100 max). */
    public $limit;

    /** @var int Total number of items available. */
    public $count;

    /** @var Activity[]|array */
    public $history;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->offset = Schema::integer();
        $properties->offset->format = "int32";
        $properties->limit = Schema::integer();
        $properties->limit->format = "int32";
        $properties->count = Schema::integer();
        $properties->count->format = "int32";
        $properties->history = Schema::arr();
        $properties->history->items = Activity::schema();
        $ownerSchema->setFromRef('#/definitions/Activities');
    }
}