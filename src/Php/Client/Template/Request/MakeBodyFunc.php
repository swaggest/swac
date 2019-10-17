<?php

namespace Swac\Php\Client\Template\Request;

use Swac\Log;
use Swac\Rest\Parameter;
use Swac\Php\Client\Template\Util;
use Swaggest\JsonSchema\Schema;
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
        $body = '';

        if (!empty($this->bodyParameters)) {
            foreach ($this->bodyParameters as $name => $parameter) {
                // TODO add support for custom serializers
                $phpName = PhpCode::makePhpName($name);
                $body = <<<PHP
return json_encode(\$this->$phpName);
PHP;

                break;
            }

        } elseif ($this->formDataParameters) {
            $body .= <<<'PHP'
$queryString = '';

PHP;
            foreach ($this->formDataParameters as $name => $parameter) {
                // TODO add support for file uploads
                if ($parameter->isFile) {
                    Log::getInstance()->addWarning('Unsupported file parameter: ' . $name);
                    continue;

                }

                if ($parameter->schema->type === Schema::_ARRAY) {
                    $body .= Util::genUrlEncode($parameter, $name);
                }

                $body .= <<<'PHP'
return substr($queryString, 1);

PHP;
            }
        } else {
            $body = 'return null;';
        }

        $this->setBody($body);
    }


}