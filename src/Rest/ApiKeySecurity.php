<?php

namespace Swac\Rest;

class ApiKeySecurity
{
    public $name;

    public $paramName;

    public $paramValuePrefix;

    public $paramIn;

    public $description;

    /**
     * ApiKeySecurity constructor.
     * @param $name
     * @param $paramName
     * @param string $paramIn
     * @param null $paramValuePrefix
     */
    public function __construct($name, $paramName, $paramIn = Parameter::HEADER, $paramValuePrefix = null)
    {
        $this->name = $name;
        $this->paramName = $paramName;
        $this->paramValuePrefix = $paramValuePrefix;
        $this->paramIn = $paramIn;
    }
}