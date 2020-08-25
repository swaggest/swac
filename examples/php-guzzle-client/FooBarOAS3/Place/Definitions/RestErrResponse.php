<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Place\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/RestErrResponse
 */
class RestErrResponse extends ClassStructure
{
    /** @var int */
    public $code;

    /** @var array */
    public $context;

    /** @var string */
    public $error;

    /** @var string */
    public $status;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->code = Schema::integer();
        $properties->context = Schema::object();
        $properties->context->additionalProperties = new Schema();
        $properties->error = Schema::string();
        $properties->status = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/RestErrResponse');
    }
}