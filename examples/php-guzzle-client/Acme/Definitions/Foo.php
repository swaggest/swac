<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Acme\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Foo
 * Built from #/definitions/Foo
 */
class Foo extends ClassStructure
{
    /** @var string */
    public $code;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->code = Schema::string();
        $properties->code->title = "Foo Code";
        $properties->code->pattern = "^[A-Z0-9]{2,3}$";
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->title = "Foo";
        $ownerSchema->required = array(
            self::names()->code,
        );
        $ownerSchema->setFromRef('#/definitions/Foo');
    }
}