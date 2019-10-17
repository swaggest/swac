<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Metadata\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/dataSetList
 */
class DataSetList extends ClassStructure
{
    /** @var int */
    public $total;

    /** @var DataSetListApisItems[]|array */
    public $apis;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->total = Schema::integer();
        $properties->apis = Schema::arr();
        $properties->apis->items = DataSetListApisItems::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/dataSetList');
    }
}