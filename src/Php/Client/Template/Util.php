<?php

namespace Swac\Php\Client\Template;

use Swac\Rest\Parameter;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\PhpCode;

class Util
{
    public static $arraySeparators = array(
        null => "','",
        Parameter::CSV => "','",
        Parameter::TSV => '"\t"',
        Parameter::SSV => "' '",
        Parameter::PIPES => "'|'",
    );


    /**
     * @param Parameter $parameter
     * @param string $name
     * @return string
     */
    public static function genUrlEncode($parameter, $name)
    {
        $body = '';
        $phpName = PhpCode::makePhpName($name);

        if ($parameter->schema->type === Schema::_ARRAY) {
            $item = $parameter->schema->items->type === Schema::STRING ? 'urlencode($item)' : '$item';
            /** @var string|null $collectionFormat */
            $collectionFormat = $parameter->collectionFormat;
            if (null === $collectionFormat) {
                $collectionFormat = Parameter::CSV;
            }
            if ($collectionFormat === Parameter::MULTI) {
                $body .= <<<PHP
if (!empty(\$this->$phpName)) {
    foreach (\$this->$phpName as \$item) {
        \$queryString .= '&$name=' . $item;
    }
}

PHP;
            } else {
                $separator = Util::$arraySeparators[$collectionFormat];
                $body .= <<<PHP
if (!empty(\$this->$phpName)) {
    \$queryString .= '&$name=' . urlencode(implode($separator, \$this->$phpName));
}

PHP;


            }
        } else {
            $value = $parameter->schema->type === Schema::STRING
                ? "urlencode(\$this->$phpName)"
                : "\$this->$phpName";

            $body .= <<<PHP
if (null !== \$this->$phpName) {
    \$queryString .= '&$name=' . $value;
}

PHP;

        }

        return $body;

    }

}