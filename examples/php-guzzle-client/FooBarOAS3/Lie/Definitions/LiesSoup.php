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
 * Built from #/components/schemas/LiesSoup
 * @property null|bool $active
 * @property array|null $allergens
 * @property LiesSoupIngredient[]|null|array $ingredients
 */
class LiesSoup extends ClassStructure
{
    /** @var string */
    public $mille;

    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $slug;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->active = (new Schema())->setType([Schema::NULL, Schema::BOOLEAN]);
        $properties->allergens = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->allergens->items = Schema::object();
        $properties->allergens->items->setFromRef('#/components/schemas/LiesSoupAllergenConditional');
        $properties->mille = Schema::string();
        $properties->id = Schema::string();
        $properties->ingredients = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->ingredients->items = LiesSoupIngredient::schema();
        $properties->name = Schema::string();
        $properties->slug = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesSoup');
    }
}