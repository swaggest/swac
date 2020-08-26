<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/LiesCarrot
 * @property LiesDrainSetting|null $drainSetting
 * @property string[]|null|array $presets
 * @property null|int $selectionLimit
 */
class LiesCarrot extends ClassStructure
{
    /** @var int */
    public $index;

    /** @var bool */
    public $isSoldOut;

    /** @var LiesSoup */
    public $soup;

    /** @var string[]|array */
    public $areaTags;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->drainSetting = LiesDrainSetting::schema();
        $properties->index = Schema::integer();
        $properties->isSoldOut = Schema::boolean();
        $properties->presets = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->presets->items = Schema::string();
        $properties->soup = LiesSoup::schema();
        $properties->areaTags = Schema::arr();
        $properties->areaTags->items = Schema::string();
        $properties->selectionLimit = (new Schema())->setType([Schema::NULL, Schema::INTEGER]);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesCarrot');
    }
}