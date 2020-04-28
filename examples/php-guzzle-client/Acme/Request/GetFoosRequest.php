<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\Acme\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class GetFoosRequest extends ClassStructure
{
    /**
     * @var string Filter Foos by postcode
     * In: query, Name: postcode
     */
    public $postcode;

    /**
     * @var string Filter Foos by activity option
     * In: query, Name: activity_option
     */
    public $activityOption;

    /**
     * @var int Filter Foos by activity day (priority over activity_option)
     * In: query, Name: activity_day
     */
    public $activityDay;

    /**
     * @var string Which project is the request coming from
     * In: query, Name: project
     */
    public $project;

    /** @var string In: query, Name: country */
    public $country;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->postcode = Schema::string();
        $properties->activityOption = Schema::string();
        $ownerSchema->addPropertyMapping('activity_option', self::names()->activityOption);
        $properties->activityDay = Schema::integer();
        $ownerSchema->addPropertyMapping('activity_day', self::names()->activityDay);
        $properties->project = Schema::string();
        $properties->country = Schema::string();
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->postcode,
            self::names()->project,
            self::names()->country,
        );
    }

    public function makeUrl()
    {
        $url = '/Foos';
        $queryString = '';
        if (null !== $this->postcode) {
            $queryString .= '&postcode=' . urlencode($this->postcode);
        }
        if (null !== $this->activityOption) {
            $queryString .= '&activity_option=' . urlencode($this->activityOption);
        }
        if (null !== $this->activityDay) {
            $queryString .= '&activity_day=' . $this->activityDay;
        }
        if (null !== $this->project) {
            $queryString .= '&project=' . urlencode($this->project);
        }
        if (null !== $this->country) {
            $queryString .= '&country=' . urlencode($this->country);
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
        $headers['Accept'] = 'application/vnd.acme.v1+json';
        return $headers;
    }

    public function makeBody()
    {
        return null;
    }
}