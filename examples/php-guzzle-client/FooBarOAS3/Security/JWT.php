<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3\Security;

use Swaggest\RestClient\Security\ApiKey;


class JWT extends ApiKey
{
    /** @var string */
    protected $name = 'Authorization';

    /** @var string */
    protected $in = ApiKey::IN_HEADER;
}