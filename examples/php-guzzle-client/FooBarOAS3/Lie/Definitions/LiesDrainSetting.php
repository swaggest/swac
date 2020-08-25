<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/LiesDrainSetting
 * @method static LiesDrainSetting|null import($data, Context $options = null)
 * @property null|int $amount
 * @property LiesRigidAmount[]|null|array $rigidAmounts
 * @property LiesRigidQuantity[]|null|array $rigidQuantities
 * @property null|int $servings
 */
class LiesDrainSetting extends ClassStructure
{
    /** @var string */
    public $reason;

    /** @var string */
    public $strategy;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->amount = (new Schema())->setType([Schema::NULL, Schema::INTEGER]);
        $properties->rigidAmounts = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->rigidAmounts->items = LiesRigidAmount::schema();
        $properties->rigidQuantities = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->rigidQuantities->items = LiesRigidQuantity::schema();
        $properties->reason = Schema::string();
        $properties->servings = (new Schema())->setType([Schema::NULL, Schema::INTEGER]);
        $properties->strategy = Schema::string();
        $ownerSchema->type = [Schema::NULL, Schema::OBJECT];
        $ownerSchema->setFromRef('#/components/schemas/LiesDrainSetting');
    }
}