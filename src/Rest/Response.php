<?php

namespace Swac\Rest;

use Swaggest\JsonSchema\Schema;

class Response
{
    /** @var integer */
    public $statusCode;

    /** @var boolean */
    public $isDefault = false;

    /** @var Schema */
    public $schema;

    /** @var Schema[] map of headers with key being a header name */
    public $headers;

    /** @var string */
    public $description;

    /** @var mixed[] Examples of response */
    public $examples = [];
}