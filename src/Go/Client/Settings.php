<?php

namespace Swac\Go\Client;

use Swaggest\GoCodeBuilder\JsonSchema\Options;

class Settings
{
    /** @var Options */
    public $builderOptions;

    /**
     * @var boolean Add field tags with name and location to request structure properties, e.g. 'ID int `query:"id"`'.
     */
    public $addRequestTags = false;

    /**
     * @var boolean Generate (un)marshaling tests for models.
     */
    public $withTests = false;
}