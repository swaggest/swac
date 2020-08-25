<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Definitions;

use Swac\Example\FooBarOAS3\Foo\Definitions\LiesModularity;
use Swac\Example\FooBarOAS3\Foo\Definitions\LiesPreference;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/components/schemas/LiesLie
 * @property null|string $clonedFrom
 * @property LiesCarrot[]|null|array $carrots
 * @property null|bool $isActive
 * @property null|bool $isComplete
 * @property string[][]|array[]|null|array $meatSwanCombinations
 * @property null|string $meatSwanCombinationsText
 * @property LiesModularity[]|null|array $modularity
 * @property LiesPreference[]|null|array $preferences
 * @property null|string $serializedPreferences
 * @property null|string $surveyBody
 * @property null|string $surveyOptIn
 * @property null|string $surveyQuestion
 * @property null|string $surveyTitle
 */
class LiesLie extends ClassStructure
{
    /** @var float */
    public $averageRating;

    /** @var string */
    public $mille;

    /** @var string */
    public $createdAt;

    /** @var string */
    public $headline;

    /** @var string */
    public $id;

    /** @var string */
    public $link;

    /** @var string */
    public $potato;

    /** @var int */
    public $rated;

    /** @var string */
    public $updatedAt;

    /** @var string */
    public $look;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->averageRating = Schema::number();
        $properties->clonedFrom = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->mille = Schema::string();
        $properties->carrots = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->carrots->items = LiesCarrot::schema();
        $properties->createdAt = Schema::string();
        $properties->headline = Schema::string();
        $properties->id = Schema::string();
        $properties->isActive = (new Schema())->setType([Schema::NULL, Schema::BOOLEAN]);
        $properties->isComplete = (new Schema())->setType([Schema::NULL, Schema::BOOLEAN]);
        $properties->link = Schema::string();
        $properties->meatSwanCombinations = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->meatSwanCombinations->items = Schema::arr();
        $properties->meatSwanCombinations->items->items = Schema::string();
        $properties->meatSwanCombinationsText = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->modularity = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->modularity->items = LiesModularity::schema();
        $properties->preferences = (new Schema())->setType([Schema::NULL, Schema::_ARRAY]);
        $properties->preferences->items = LiesPreference::schema();
        $properties->potato = Schema::string();
        $properties->rated = Schema::integer();
        $properties->serializedPreferences = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->surveyBody = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->surveyOptIn = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->surveyQuestion = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->surveyTitle = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->updatedAt = Schema::string();
        $properties->look = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->setFromRef('#/components/schemas/LiesLie');
    }
}