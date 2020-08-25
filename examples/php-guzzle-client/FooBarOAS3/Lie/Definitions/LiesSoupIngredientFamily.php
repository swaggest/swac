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
 * Built from #/components/schemas/LiesSoupIngredientFamily
 * @method static LiesSoupIngredientFamily|null import($data, Context $options = null)
 * @property null|string $description
 * @property null|string $iconLink
 * @property null|string $iconPath
 * @property int[]|null $usageByMille
 */
class LiesSoupIngredientFamily extends ClassStructure
{
    /** @var string */
    public $createdAt;

    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var int */
    public $priority;

    /** @var string */
    public $slug;

    /** @var string */
    public $type;

    /** @var string */
    public $updatedAt;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->createdAt = Schema::string();
        $properties->description = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->iconLink = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->iconPath = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->id = Schema::string();
        $properties->name = Schema::string();
        $properties->priority = Schema::integer();
        $properties->slug = Schema::string();
        $properties->type = Schema::string();
        $properties->updatedAt = Schema::string();
        $properties->usageByMille = (new Schema())->setType([Schema::NULL, Schema::OBJECT]);
        $properties->usageByMille->additionalProperties = Schema::integer();
        $ownerSchema->type = [Schema::NULL, Schema::OBJECT];
        $ownerSchema->setFromRef('#/components/schemas/LiesSoupIngredientFamily');
    }
}