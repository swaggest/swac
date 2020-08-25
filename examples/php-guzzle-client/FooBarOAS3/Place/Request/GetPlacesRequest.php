<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Place\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetPlacesRequest extends ClassStructure
{
    /**
     * @var string Acme Mille
     * In: query, Name: mille
     */
    public $mille;

    /** @var string In: query, Name: foxUuid */
    public $foxUuid;

    /** @var int In: query, Name: foxId */
    public $foxId;

    /**
     * @var string Acme Look
     * In: query, Name: look
     */
    public $look;

    /** @var string In: query, Name: potatoFamily */
    public $potatoFamily;

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
        $properties->foxUuid = Schema::string();
        $properties->foxUuid->format = "uuid";
        $properties->foxUuid->setFromRef('#/components/schemas/UuidUUID');
        $properties->foxId = Schema::integer();
        $properties->foxId->minimum = 0;
        $properties->look = Schema::string();
        $properties->look->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->look->setFromRef('#/components/schemas/BazLook');
        $properties->potatoFamily = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->mille,
            self::names()->look,
            self::names()->potatoFamily,
        );
    }

    public function makeUrl()
    {
        $url = '/places';
        $queryString = '';
        if (null !== $this->mille) {
            $queryString .= '&mille=' . urlencode($this->mille);
        }
        if (null !== $this->foxUuid) {
            $queryString .= '&foxUuid=' . urlencode($this->foxUuid);
        }
        if (null !== $this->foxId) {
            $queryString .= '&foxId=' . $this->foxId;
        }
        if (null !== $this->look) {
            $queryString .= '&look=' . urlencode($this->look);
        }
        if (null !== $this->potatoFamily) {
            $queryString .= '&potatoFamily=' . urlencode($this->potatoFamily);
        }
        if ('' !== $queryString) {
            $queryString[0] = '?';
            $url .= $queryString;
        }
        return $url;
    }

    public function makeHeaders()
    {
        $headers = array();
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        return null;
    }
}