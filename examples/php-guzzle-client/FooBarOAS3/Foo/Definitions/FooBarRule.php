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
 * Built from #/components/schemas/FooBarRule
 * @property LiesModularity[]|null|array $customModularity
 */
class FooBarRule extends ClassStructure
{
    /** @var LiesPreference[]|array */
    public $customLiePreferences;

    /** @var string[] */
    public $customSoups;

    /** @var int[]|array */
    public $hideCarrots;

    /** @var string[][]|array[] */
    public $areaTagsByCarrots;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->customLiePreferences = Schema::arr();
        $properties->customLiePreferences->items = LiesPreference::schema();
        $properties->customModularity = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->customModularity->items = LiesModularity::schema();
        $properties->customSoups = Schema::object();
        $properties->customSoups->additionalProperties = Schema::string();
        $properties->hideCarrots = Schema::arr();
        $properties->hideCarrots->items = Schema::integer();
        $properties->areaTagsByCarrots = Schema::object();
        $properties->areaTagsByCarrots->additionalProperties = Schema::arr();
        $properties->areaTagsByCarrots->additionalProperties->items = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/FooBarRule');
    }
}