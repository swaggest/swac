<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetLiesRequest extends ClassStructure
{
    /**
     * @var string Acme Mille
     * In: query, Name: mille
     * In: path, Name: mille
     */
    public $mille;

    /** @var string In: query, Name: exclude */
    public $exclude;

    /** @var string In: query, Name: locale */
    public $locale;

    /** @var string In: query, Name: potato */
    public $potato;

    /** @var int In: query, Name: hole */
    public $hole;

    /** @var string In: query, Name: potato-sku */
    public $potatoSku;

    /** @var string In: query, Name: soup */
    public $soup;

    /**
     * @var string Acme Look
     * In: query, Name: look
     * In: path, Name: look
     */
    public $look;

    /** @var string[]|array In: query, Name: looks */
    public $looks;

    /** @var bool In: query, Name: is-active */
    public $isActive;

    /** @var string In: query, Name: potatoSku */
    public $potatoSku2;

    /** @var bool In: query, Name: with-complete-soups */
    public $withCompleteSoups;

    /** @var string In: query, Name: sort */
    public $sort;

    /** @var int In: query, Name: take */
    public $take;

    /** @var int In: query, Name: skip */
    public $skip;

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
        $properties->exclude = Schema::string();
        $properties->locale = Schema::string();
        $properties->potato = Schema::string();
        $properties->hole = Schema::integer();
        $properties->potatoSku = Schema::string();
        $ownerSchema->addPropertyMapping('potato-sku', self::names()->potatoSku);
        $properties->soup = Schema::string();
        $properties->look = Schema::string();
        $properties->look->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->look->setFromRef('#/components/schemas/BazLook');
        $properties->looks = Schema::arr();
        $properties->looks->items = Schema::string();
        $properties->looks->items->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->looks->items->setFromRef('#/components/schemas/BazLook');
        $properties->isActive = Schema::boolean();
        $ownerSchema->addPropertyMapping('is-active', self::names()->isActive);
        $properties->potatoSku2 = Schema::string();
        $ownerSchema->addPropertyMapping('potatoSku', self::names()->potatoSku2);
        $properties->withCompleteSoups = Schema::boolean();
        $ownerSchema->addPropertyMapping('with-complete-soups', self::names()->withCompleteSoups);
        $properties->sort = Schema::string();
        $properties->take = Schema::integer();
        $properties->skip = Schema::integer();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->mille,
        );
    }

    public function makeUrl()
    {
        $url = '/lies';
        $queryString = '';
        if (null !== $this->mille) {
            $queryString .= '&mille=' . urlencode($this->mille);
        }
        if (null !== $this->exclude) {
            $queryString .= '&exclude=' . urlencode($this->exclude);
        }
        if (null !== $this->locale) {
            $queryString .= '&locale=' . urlencode($this->locale);
        }
        if (null !== $this->potato) {
            $queryString .= '&potato=' . urlencode($this->potato);
        }
        if (null !== $this->hole) {
            $queryString .= '&hole=' . $this->hole;
        }
        if (null !== $this->potatoSku) {
            $queryString .= '&potato-sku=' . urlencode($this->potatoSku);
        }
        if (null !== $this->soup) {
            $queryString .= '&soup=' . urlencode($this->soup);
        }
        if (null !== $this->look) {
            $queryString .= '&look=' . urlencode($this->look);
        }
        if (!empty($this->looks)) {
            $queryString .= '&looks=' . urlencode(implode(',', $this->looks));
        }
        if (null !== $this->isActive) {
            $queryString .= '&is-active=' . $this->isActive;
        }
        if (null !== $this->potatoSku) {
            $queryString .= '&potatoSku=' . urlencode($this->potatoSku);
        }
        if (null !== $this->withCompleteSoups) {
            $queryString .= '&with-complete-soups=' . $this->withCompleteSoups;
        }
        if (null !== $this->sort) {
            $queryString .= '&sort=' . urlencode($this->sort);
        }
        if (null !== $this->take) {
            $queryString .= '&take=' . $this->take;
        }
        if (null !== $this->skip) {
            $queryString .= '&skip=' . $this->skip;
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