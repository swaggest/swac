<?php

namespace Swac\Php\Client\Template\Request;

use Swac\Rest\Parameter;
use Swac\Php\Client\Template\Util;
use Swac\Skip;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;

class MakeBodyFunc extends PhpFunction
{
    /** @var Parameter[] */
    public $formDataParameters = array();

    /** @var Parameter[] */
    public $bodyParameters = array();


    protected function prepareOnce()
    {
        $this->setVisibility(PhpFlags::VIS_PUBLIC);
        $body = 'return null;';

        if (!empty($this->bodyParameters)) {
            foreach ($this->bodyParameters as $name => $parameter) {
                // TODO add support for custom serializers
                $phpName = PhpCode::makePhpName($name);
                $body = <<<PHP
return json_encode(\$this->$phpName);
PHP;

                break;
            }

        } elseif (!empty($this->formDataParameters)) {
            $body = <<<'PHP'
$queryString = '';

PHP;
            foreach ($this->formDataParameters as $name => $parameter) {
                // TODO add support for file uploads
                if ($parameter->isFile) {
                    throw new Skip('Unsupported file parameter: ' . $name);
                }

                $body .= Util::genUrlEncode($parameter, $name);
            }

            $body .= <<<'PHP'
if ('' !== $queryString) {
    return substr($queryString, 1);
}
return null;

PHP;
        }
        $this->setBody($body);
    }


}