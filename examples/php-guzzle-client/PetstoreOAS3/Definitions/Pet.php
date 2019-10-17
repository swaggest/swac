<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\PetstoreOAS3\Definitions;

use Swac\Example\PetstoreOAS3\Response\GetPetsOKResponseItemsAllOf1;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/Pet
 * @method static NewPet|GetPetsOKResponseItemsAllOf1 import($data, Context $options = null)
 */
class Pet extends ClassStructure
{
    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $ownerSchema->allOf[0] = NewPet::schema();
        $ownerSchema->allOf[1] = GetPetsOKResponseItemsAllOf1::schema();
        $ownerSchema->setFromRef('#/components/schemas/Pet');
    }
}