<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Lie\Request;

use Swac\Example\FooBarOAS3\Lie\Definitions\UsecaseFindAvailableCarrotsInput;
use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class PostInternalFindAvailableCarrotsMilleLookRequest extends ClassStructure
{
    /**
     * @var string Acme Mille
     * In: query, Name: mille
     * In: path, Name: mille
     */
    public $mille;

    /**
     * @var string Acme Look
     * In: query, Name: look
     * In: path, Name: look
     */
    public $look;

    /** @var UsecaseFindAvailableCarrotsInput In: body, Name: body */
    public $body;

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
        $properties->look = Schema::string();
        $properties->look->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->look->setFromRef('#/components/schemas/BazLook');
        $properties->body = UsecaseFindAvailableCarrotsInput::schema();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->mille,
            self::names()->look,
        );
    }

    public function makeUrl()
    {
        $url = '/internal/find-available-carrots/' . urlencode($this->mille) . '/' . urlencode($this->look);
        return $url;
    }

    public function makeHeaders()
    {
        $headers = array();
        $headers['Content-Type'] = 'application/json; charset=utf-8';
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        return json_encode($this->body);
    }
}