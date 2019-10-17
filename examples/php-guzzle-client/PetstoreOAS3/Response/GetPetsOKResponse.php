<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\PetstoreOAS3\Response;

use Swac\Example\PetstoreOAS3\Definitions\NewPet;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * @method static NewPet[]|GetPetsOKResponseItemsAllOf1[]|array import($data, Context $options = null)
 */
class GetPetsOKResponse extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->type = Schema::_ARRAY;
        $ownerSchema->items = new Schema();
        $ownerSchema->items->allOf[0] = NewPet::schema();
        $ownerSchema->items->allOf[1] = GetPetsOKResponseItemsAllOf1::schema();
        $ownerSchema->items->setFromRef('#/components/schemas/Pet');
    }
}