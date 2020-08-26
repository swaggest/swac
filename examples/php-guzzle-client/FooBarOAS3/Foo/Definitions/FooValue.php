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
 * In: body, Name: body
 * Built from #/components/schemas/FooValue
 * @property null|string $activateSince
 * @property null|string $activateTill
 * @property FooBarRule[]|null $barRules
 */
class FooValue extends ClassStructure
{
    /**
     * @var string Acme Mille
     * In: query, Name: mille
     */
    public $mille;

    /** @var FooLocalActivation[] */
    public $localActivation;

    /** @var string */
    public $uselyKey;

    /** @var string */
    public $potatoFamily;

    /**
     * @var string Acme Look
     * In: query, Name: look
     */
    public $lookEnd;

    /**
     * @var string Acme Look
     * In: query, Name: look
     */
    public $lookStart;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->activateSince = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->activateSince->format = "date-time";
        $properties->activateTill = (new Schema())->setType([Schema::NULL, Schema::STRING]);
        $properties->activateTill->format = "date-time";
        $properties->mille = Schema::string();
        $properties->mille->maxLength = 2;
        $properties->mille->minLength = 2;
        $properties->mille->pattern = "^[a-zA-Z]{2}$";
        $properties->mille->setFromRef('#/components/schemas/BazMille');
        $properties->localActivation = Schema::object();
        $properties->localActivation->additionalProperties = FooLocalActivation::schema();
        $properties->localActivation->setFromRef('#/components/schemas/FooLocalActivations');
        $properties->uselyKey = Schema::string();
        $properties->uselyKey->minLength = 1;
        $properties->potatoFamily = Schema::string();
        $properties->potatoFamily->minLength = 1;
        $properties->barRules = (new Schema())->setType([Schema::NULL, Schema::OBJECT]);
        $properties->barRules->additionalProperties = FooBarRule::schema();
        $properties->barRules->setFromRef('#/components/schemas/FooBarRules');
        $properties->lookEnd = Schema::string();
        $properties->lookEnd->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->lookEnd->setFromRef('#/components/schemas/BazLook');
        $properties->lookStart = Schema::string();
        $properties->lookStart->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->lookStart->setFromRef('#/components/schemas/BazLook');
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->uselyKey,
            self::names()->lookStart,
            self::names()->lookEnd,
            self::names()->mille,
            self::names()->potatoFamily,
            self::names()->barRules,
        );
        $ownerSchema->setFromRef('#/components/schemas/FooValue');
    }
}