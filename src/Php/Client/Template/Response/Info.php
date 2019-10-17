<?php

namespace Swac\Php\Client\Template\Response;

use Swac\Rest\Response;
use Swaggest\PhpCodeBuilder\PhpAnyType;

class Info
{
    public $statusPhrase;
    public $statusCode;
    /** @var PhpAnyType */
    public $type;
    /** @var Response */
    public $response;
}