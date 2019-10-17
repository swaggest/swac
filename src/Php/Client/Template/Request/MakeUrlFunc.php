<?php

namespace Swac\Php\Client\Template\Request;


use Swac\Rest\Parameter;
use Swac\Php\Client\Template\Util;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;

class MakeUrlFunc extends PhpFunction
{
    public $path;
    /** @var Parameter[] */
    public $pathParameters = array();
    /** @var Parameter[] */
    public $queryParameters = array();

    protected function prepareOnce()
    {
        $this->setVisibility(PhpFlags::VIS_PUBLIC);

        $path = '\'' . $this->path . '\'';
        foreach ($this->pathParameters as $name => $param) {
            $phpName = PhpCode::makePhpName($name);
            if ($param->schema->type === Schema::_ARRAY) {
                $collectionFormat = $param->collectionFormat ? $param->collectionFormat : Parameter::CSV;
                $separator = Util::$arraySeparators[$collectionFormat];
                $value = "implode($separator, \$this->$phpName)";
            } else {
                $value = "\$this->$phpName";
            }
            $path = str_replace('{' . $name . '}', "' . urlencode($value) . '", $path);
        }
        $path = str_replace(" . ''", '', $path);

        $body = <<<PHP
\$url = $path;

PHP;
        if ($this->queryParameters) {
            $body .= <<<'PHP'
$queryString = '';

PHP;

            foreach ($this->queryParameters as $name => $parameter) {
                $body .= Util::genUrlEncode($parameter, $name);
            }

            $body .= <<<'PHP'
if ('' !== $queryString) {
    $queryString[0] = '?';
    $url .= $queryString;
}

PHP;

        }

        $body .= <<<'PHP'
return $url;

PHP;


        $this->setBody($body);
    }

}