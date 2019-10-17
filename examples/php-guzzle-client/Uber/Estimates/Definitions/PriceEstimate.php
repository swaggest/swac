<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\Estimates\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/PriceEstimate
 */
class PriceEstimate extends ClassStructure
{
    /** @var string Unique identifier representing a specific product for a given latitude & longitude. For example, uberX in San Francisco will have a different product_id than uberX in Los Angeles */
    public $productId;

    /** @var string [ISO 4217](http://en.wikipedia.org/wiki/ISO_4217) currency code. */
    public $currencyCode;

    /** @var string Display name of product. */
    public $displayName;

    /** @var string Formatted string of estimate in local currency of the start location. Estimate could be a range, a single number (flat rate) or "Metered" for TAXI. */
    public $estimate;

    /** @var float Lower bound of the estimated price. */
    public $lowEstimate;

    /** @var float Upper bound of the estimated price. */
    public $highEstimate;

    /** @var float Expected surge multiplier. Surge is active if surge_multiplier is greater than 1. Price estimate already factors in the surge multiplier. */
    public $surgeMultiplier;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->productId = Schema::string();
        $ownerSchema->addPropertyMapping('product_id', self::names()->productId);
        $properties->currencyCode = Schema::string();
        $ownerSchema->addPropertyMapping('currency_code', self::names()->currencyCode);
        $properties->displayName = Schema::string();
        $ownerSchema->addPropertyMapping('display_name', self::names()->displayName);
        $properties->estimate = Schema::string();
        $properties->lowEstimate = Schema::number();
        $ownerSchema->addPropertyMapping('low_estimate', self::names()->lowEstimate);
        $properties->highEstimate = Schema::number();
        $ownerSchema->addPropertyMapping('high_estimate', self::names()->highEstimate);
        $properties->surgeMultiplier = Schema::number();
        $ownerSchema->addPropertyMapping('surge_multiplier', self::names()->surgeMultiplier);
        $ownerSchema->setFromRef('#/definitions/PriceEstimate');
    }
}