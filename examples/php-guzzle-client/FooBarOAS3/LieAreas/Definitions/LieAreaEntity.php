<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\LieAreas\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/LieAreaEntity
 * @property string[]|null|array $areas
 * @property null|string $updatedAt
 */
class LieAreaEntity extends ClassStructure
{
    /**
     * @var string Acme Mille
     * In: query, Name: mille
     * In: path, Name: mille
     */
    public $mille;

    /** @var string */
    public $createdAt;

    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->mille = Schema::string();
        $properties->mille->maxLength = 2;
        $properties->mille->minLength = 2;
        $properties->mille->pattern = "^[a-zA-Z]{2}$";
        $properties->mille->setFromRef('#/components/schemas/BazMille');
        $properties->createdAt = Schema::string();
        $properties->createdAt->format = "date-time";
        $properties->id = Schema::integer();
        $properties->name = Schema::string();
        $properties->areas = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->areas->items = Schema::string();
        $properties->areas->setFromRef('#/components/schemas/PqStringArray');
        $properties->updatedAt = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->updatedAt->format = "date-time";
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->areas,
            self::names()->mille,
            self::names()->name,
        );
        $ownerSchema->setFromRef('#/components/schemas/LieAreaEntity');
    }
}