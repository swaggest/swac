<?php

namespace Swac\Go\Client;

class Settings
{
    /**
     * @var boolean If schema is not defined fallback to create it from example.
     */
    public $schemaFromExamples = false;

    /**
     * @var boolean Do not add field property for undefined `additionalProperties`.
     */
    public $skipDefaultAdditionalProperties = false;

    /**
     * @var boolean Add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`'.
     */
    public $addRequestTags = false;

    /** @var bool */
    public $requireXGenerate = false;
}