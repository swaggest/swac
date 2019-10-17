<?php

namespace Swac\Rest;

class Config
{
    public $baseUrl;

    /** @var ApiKeySecurity[] */
    public $apiKeySecurityList;

    /** @var string A unique and precise title of the API. */
    public $title;

    /** @var string A longer description of the API. Should be different from the title.  GitHub Flavored Markdown is allowed. */
    public $description;

    /** @var string[] map of other info */
    public $info;

}