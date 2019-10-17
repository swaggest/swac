<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Uber\User\Definitions;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


/**
 * Built from #/definitions/Profile
 */
class Profile extends ClassStructure
{
    /** @var string First name of the Uber user. */
    public $firstName;

    /** @var string Last name of the Uber user. */
    public $lastName;

    /** @var string Email address of the Uber user */
    public $email;

    /** @var string Image URL of the Uber user. */
    public $picture;

    /** @var string Promo code of the Uber user. */
    public $promoCode;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->firstName = Schema::string();
        $ownerSchema->addPropertyMapping('first_name', self::names()->firstName);
        $properties->lastName = Schema::string();
        $ownerSchema->addPropertyMapping('last_name', self::names()->lastName);
        $properties->email = Schema::string();
        $properties->picture = Schema::string();
        $properties->promoCode = Schema::string();
        $ownerSchema->addPropertyMapping('promo_code', self::names()->promoCode);
        $ownerSchema->setFromRef('#/definitions/Profile');
    }
}