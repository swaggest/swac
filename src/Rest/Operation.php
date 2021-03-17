<?php

namespace Swac\Rest;

class Operation
{
    /** @var string */
    public $path;

    /** @var string */
    public $method;

    /** @var string */
    public $operationId;

    /** @var string */
    public $summary;

    /** @var string */
    public $description;

    public function getSummaryOrDescription()
    {
        $res = ($this->summary ? $this->summary : $this->description);
        $lines = explode("\n", wordwrap($res));
        return $lines[0];
    }

    /** @var []string */
    public $tags;

    /** @var [][]string */
    public $security;

    public function getMethodUppercase()
    {
        return strtoupper($this->method);
    }

    /** @var Parameter[] map of parameters with "$in:$name" as a key */
    public $parameters;

    /** @var Response[] */
    public $responses;

    /** @var string request content type add to Content-Type header */
    public $contentType;

    /** @var string response type to add to Accept header */
    public $accept;
}