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
}