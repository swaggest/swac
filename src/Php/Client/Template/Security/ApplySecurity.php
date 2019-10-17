<?php

namespace Swac\Php\Client\Template\Security;

use Swac\Php\Client\Template\ConfigClass;
use Swaggest\PhpCodeBuilder\NamedReference;
use Swaggest\PhpCodeBuilder\PhpCode;

class ApplySecurity extends PhpCode
{
    /**
     * ApplySecurity constructor.
     * @param ConfigClass $configClass
     * @param [][]string $securityRequirements
     */
    public function __construct(ConfigClass $configClass, $securityRequirements)
    {
        if ($securityRequirements) { // []map[string][]string
            $this->addSnippet('$this->applySecurity([');
            $first = true;
            foreach ($securityRequirements as $securityGroup) {
                $this->addSnippet($first ? '[' : ', [');
                foreach ($securityGroup as $securityName => $scopes) {
                    $this->addSnippet(new NamedReference(PhpCode::makePhpConstantName($securityName), $configClass));
                }
                $this->addSnippet(']');
                $first = false;
            }
            $this->addSnippet('], $config);');
        }
    }
}