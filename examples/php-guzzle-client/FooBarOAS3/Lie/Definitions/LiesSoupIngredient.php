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
 * Built from #/components/schemas/LiesSoupIngredient
 * @property array|null $allergens
 * @property null|string $description
 * @property LiesSoupIngredientFamily|null $family
 * @property null|bool $hasDuplicatedName
 * @property null|string $imageLink
 * @property null|string $imagePath
 * @property null|string $internalName
 * @property null|bool $shipped
 */
class LiesSoupIngredient extends ClassStructure
{
    /** @var string */
    public $mille;

    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $slug;

    /** @var string */
    public $type;

    /** @var int */
    public $usage;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->allergens = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->allergens->items = Schema::object();
        $properties->allergens->items->setFromRef('#/components/schemas/LiesSoupAllergenConditional');
        $properties->mille = Schema::string();
        $properties->description = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->family = LiesSoupIngredientFamily::schema();
        $properties->hasDuplicatedName = (new Schema())->setType([Schema::NULL, Schema::BOOLEAN]);
        $properties->id = Schema::string();
        $properties->imageLink = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->imagePath = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->internalName = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->name = Schema::string();
        $properties->shipped = (new Schema())->setType([Schema::NULL, Schema::BOOLEAN]);
        $properties->slug = Schema::string();
        $properties->type = Schema::string();
        $properties->usage = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesSoupIngredient');
    }
}