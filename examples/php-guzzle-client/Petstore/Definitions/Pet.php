<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Petstore\Definitions;

use Swac\Example\Petstore\Response\GetPetsOKResponseItemsAllOf1;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Pet
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
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->allOf[0] = NewPet::schema();
        $ownerSchema->allOf[1] = GetPetsOKResponseItemsAllOf1::schema();
        $ownerSchema->setFromRef('#/definitions/Pet');
    }
}