<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\UsptoOAS3\Search\Request;

use Swaggest\JsonSchema\Constraint\Properties;
use Swaggest\JsonSchema\Schema;
use Swaggest\JsonSchema\Structure\ClassStructure;


class PerformSearchRequest extends ClassStructure
{
    /** @var string In: path, Name: version */
    public $version;

    /** @var string In: path, Name: dataset */
    public $dataset;

    /**
     * @var string Uses Lucene Query Syntax in the format of propertyName:value, propertyName:[num1 TO num2] and date range format: propertyName:[yyyyMMdd TO yyyyMMdd]. In the response please see the 'docs' element which has the list of record objects. Each record structure would consist of all the fields and their corresponding values.
     * In: formData, Name: criteria
     */
    public $criteria;

    /**
     * @var int Starting record number. Default value is 0.
     * In: formData, Name: start
     */
    public $start;

    /**
     * @var int Specify number of rows to be returned. If you run the search with default values, in the response you will see 'numFound' attribute which will tell the number of records available in the dataset.
     * In: formData, Name: rows
     */
    public $rows;

    /**
     * @param Properties|static $properties
     * @param Schema $ownerSchema
     */
    public static function setUpProperties($properties, Schema $ownerSchema)
    {
        $properties->version = Schema::string();
        $properties->version->default = "v1";
        $properties->dataset = Schema::string();
        $properties->dataset->default = "oa_citations";
        $properties->criteria = Schema::string();
        $properties->criteria->default = "*:*";
        $properties->start = Schema::integer();
        $properties->start->default = 0;
        $properties->rows = Schema::integer();
        $properties->rows->default = 100;
        $ownerSchema->type = Schema::OBJECT;
        $ownerSchema->required = array(
            self::names()->version,
            self::names()->dataset,
            self::names()->criteria,
        );
    }

    public function makeUrl()
    {
        $url = '/' . urlencode($this->dataset) . '/' . urlencode($this->version) . '/records';
        return $url;
    }

    public function makeHeaders()
    {
        $headers = array();
        $headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $headers['Accept'] = 'application/json';
        return $headers;
    }

    public function makeBody()
    {
        $queryString = '';
        if (null !== $this->criteria) {
            $queryString .= '&criteria=' . urlencode($this->criteria);
        }
        if (null !== $this->start) {
            $queryString .= '&start=' . $this->start;
        }
        if (null !== $this->rows) {
            $queryString .= '&rows=' . $this->rows;
        }
        if ('' !== $queryString) {
            return substr($queryString, 1);
        }
        return null;
    }
}