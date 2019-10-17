<?php

namespace Swac\Php\Client\Template\Response;


use Psr\Http\Message\ResponseInterface;
use Swac\Rest\Parameter;
use Swac\Php\Client\Template\Util;
use Swaggest\CodeBuilder\PlaceholderString;
use Swaggest\JsonSchema\Context;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Types\TypeOf;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\PhpCode;
use Swaggest\PhpCodeBuilder\PhpFlags;
use Swaggest\PhpCodeBuilder\PhpFunction;
use Swaggest\PhpCodeBuilder\PhpNamedVar;
use Swaggest\PhpCodeBuilder\PhpStdType;

class HeadersReadFuncBuilder
{
    private $code;

    public function __construct()
    {
        $this->code = new PhpCode();
        $this->code->addSnippet('$data = array();' . "\n");
    }

    public function addHeader($name, Schema $schema)
    {
        if ($schema->type === Schema::_ARRAY) {
            $collectionFormat = $schema->getMeta(Parameter::COLLECTION_FORMAT);
            $separator = Util::$arraySeparators[$collectionFormat];

            $this->code->addSnippet("\$data['$name'] = explode($separator, \$raw->getHeaderLine('$name'));\n");
        } else {
            $this->code->addSnippet("\$data['$name'] = \$raw->getHeaderLine('$name');\n");
        }
    }

    public function build()
    {
        $func = new PhpFunction('read', PhpFlags::VIS_PUBLIC, true);
        $func->addArgument(new PhpNamedVar('raw', PhpClass::byFQN(ResponseInterface::class)));
        $func->setResult(PhpStdType::tStatic());

        $this->code->addSnippet(new PlaceholderString(<<<'PHP'
$options = new :context();
$options->tolerateStrings = true;
return self::import((object)$data, $options);
PHP
            , array(':context' => new TypeOf(PhpClass::byFQN(Context::class)))));

        $func->setBody($this->code);
        return $func;
    }


}