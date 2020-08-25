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
 * Built from #/components/schemas/LiesModularity
 * @property LiesModularityAddOns[]|null|array $addOns
 * @property null|string $addOnsHeadline
 * @property null|string $noAddOnsDefaultTitle
 * @property null|string $noBarsDefaultTitle
 * @property null|string $promoTitle
 * @property LiesModularityBar[]|null|array $bars
 * @property null|string $barsHeadline
 */
class LiesModularity extends ClassStructure
{
    /** @var int */
    public $defaultCarrotIndex;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->addOns = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->addOns->items = LiesModularityAddOns::schema();
        $properties->addOnsHeadline = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->defaultCarrotIndex = Schema::integer();
        $properties->noAddOnsDefaultTitle = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->noBarsDefaultTitle = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->promoTitle = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->bars = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->bars->items = LiesModularityBar::schema();
        $properties->barsHeadline = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesModularity');
    }
}