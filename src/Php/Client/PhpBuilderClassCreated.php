<?php

namespace Swac\Php\Client;

use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilderClassHook;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Yaoi\String\StringValue;

class PhpBuilderClassCreated implements PhpBuilderClassHook
{
    private $namespace;

    /**
     * PhpBuilderClassCreated constructor.
     * @param $namespace
     */
    public function __construct($namespace)
    {
        $this->namespace = $namespace;
    }

    public function process(PhpClass $class, $path, $schema)
    {
        $desc = '';
        if ($schema->title) {
            $desc = $schema->title;
        }
        if ($schema->description) {
            $desc .= "\n" . $schema->description;
        }
        if ($fromRefs = $schema->getFromRefs()) {
            $desc .= "\nBuilt from " . implode("\n" . ' <- ', $fromRefs);
        }

        $class->setDescription(trim($desc));

        // #/definitions/issues->items->labels->items
        if (false !== $s = $this->afterStarts($path, '#/definitions/')) {
            $class->setNamespace($this->namespace . '\Definitions');
            $class->setName(PhpCode::makePhpName($s, false));
        } elseif (false !== $s = $this->afterStarts($path, '#/components/schemas')) {
            $class->setNamespace($this->namespace . '\Definitions');
            $class->setName(PhpCode::makePhpName($s, false));
        } elseif (substr($path, 0, 9) === 'response/') {
            $class->setNamespace($this->namespace . '\Response');
            $class->setName(PhpCode::makePhpName(substr($path, 9), false));
        } elseif (substr($path, 0, 8) === 'request/') {
            $class->setNamespace($this->namespace . '\Request');
            $class->setName(PhpCode::makePhpName(substr($path, 8), false));
        } else {
//            $class->setNamespace($this->namespace . '\Definitions');
//            $class->setName(PhpCode::makePhpName($path));
            throw new \Exception('Could not pick namespace for path: ' . $path);
        }
//        $class->setDescription("Path: $path\nSchema:\n" . json_encode($schema, JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES));
    }

    /**
     * Returns substring after provided start or false if string starts differently
     *
     * @param $string
     * @param $substring
     * @param bool $ignoreCase
     * @return bool|string
     */
    private function afterStarts($string, $substring, $ignoreCase = false)
    {
        $strLen = strlen($substring);
        if ($ignoreCase) {
            $starts = strtolower(substr($string, 0, $strLen)) === strtolower($substring);
        } else {
            $starts = substr($string, 0, $strLen) === $substring;
        }
        return $starts ? substr($string, $strLen) : false;
    }

}