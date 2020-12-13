<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\LieAreas\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class PutLieAreasMilleLieAreaSyncRequest extends ClassStructure
{
    /**
     * @var string Acme Look
     * In: query, Name: look
     * In: path, Name: look
     */
    public $look;

    /**
     * @var string Acme Mille
     * In: query, Name: mille
     * In: path, Name: mille
     */
    public $mille;

    /**
     * @var string Name of lie area.
     * In: path, Name: LieArea
     */
    public $lieArea;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->look = Schema::string();
        $properties->look->pattern = "^[0-9]{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$";
        $properties->look->setFromRef('#/components/schemas/BazLook');
        $properties->mille = Schema::string();
        $properties->mille->maxLength = 2;
        $properties->mille->minLength = 2;
        $properties->mille->pattern = "^[a-zA-Z]{2}$";
        $properties->mille->setFromRef('#/components/schemas/BazMille');
        $properties->lieArea = Schema::string();
        $ownerSchema->addPropertyMapping('LieArea', self::names()->lieArea);
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->look,
            self::names()->mille,
            'LieArea',
        );
    }

    public function makeUrl()
    {
        $url = '/lie-areas/' . urlencode($this->mille) . '/' . urlencode($this->lieArea) . '/sync';
        $queryString = '';
        if (null !== $this->look) {
            $queryString .= '&look=' . urlencode($this->look);
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