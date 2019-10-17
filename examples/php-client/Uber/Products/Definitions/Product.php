<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Products\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Product
 */
class Product extends ClassStructure
{
    /** @var string Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles. */
    public $productId;

    /** @var string Description of product. */
    public $description;

    /** @var string Display name of product. */
    public $displayName;

    /** @var string Capacity of product. For example, 4 people. */
    public $capacity;

    /** @var string Image URL representing the product. */
    public $image;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->productId = Schema::string();
        $ownerSchema->addPropertyMapping('product_id', self::names()->productId);
        $properties->description = Schema::string();
        $properties->displayName = Schema::string();
        $ownerSchema->addPropertyMapping('display_name', self::names()->displayName);
        $properties->capacity = Schema::string();
        $properties->image = Schema::string();
        $ownerSchema->setFromRef('#/definitions/Product');
    }
}