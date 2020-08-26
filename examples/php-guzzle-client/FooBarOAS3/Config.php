<?php
/**
 * @file ATTENTION!!! The code below was carefully crafted by a mean machine.
 * Please consider to NOT put any emotional human-generated modifications as the splendid AI will throw them away with no mercy.
 */

namespace Swac\Example\FooBarOAS3;

use Swac\Example\FooBarOAS3\Security\JWT;
use Swaggest\RestClient\AbstractConfig;


class Config extends AbstractConfig
{
    const JWT = 'JWT';

    /**
     * @param JWT $jWT
     * @return $this
     * @codeCoverageIgnoreStart
     */
    public function setJWT(JWT $jWT)
    {
        $this->security[self::JWT] = $jWT;
        return $this;
    }
    /** @codeCoverageIgnoreEnd */
}