<?php

namespace Swac\Php\Client\Template\Request;

use Swac\Rest\Parameter;
use Swac\Php\Client\Template\Util;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;

class MakeHeadersFunc extends PhpFunction
{
    /** @var Parameter[] */
    public $headerParameters = array();

    protected function prepareOnce()
    {
        $this->setVisibility(PhpFlags::VIS_PUBLIC);
        $body = <<<'PHP'
$headers = array();

PHP;


        foreach ($this->headerParameters as $name => $parameter) {
            $phpName = PhpCode::makePhpName($name);

            if ($parameter->schema->type === Schema::_ARRAY) {
                $collectionFormat = $parameter->collectionFormat
                    ? $parameter->collectionFormat
                    : Parameter::CSV;
                $separator = Util::$arraySeparators[$collectionFormat];
                $body .= <<<PHP
if (null !== \$this->$phpName) {
    \$headers['$name'] = implode($separator, \$this->$phpName);
}

PHP;

            } else {
                $body .= <<<PHP
if (null !== \$this->$phpName) {
    \$headers['$name'] = \$this->$phpName;
}

PHP;
            }
        }

        $body .= <<<'PHP'
return $headers;

PHP;

        $this->setBody($body);
    }

}