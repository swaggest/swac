<?php


namespace Swac\Go;


use Swaggest\GoCodeBuilder\Templates\Code;
use Swaggest\GoCodeBuilder\Templates\Type\AnyType;

class LiteralType implements AnyType
{
    /** @var Code */
    private $code;

    public function __construct(Code $code)
    {
        $this->code = $code;
    }

    public function render()
    {
        return $this->code->render();
    }

    public function getTypeString()
    {
        return $this->code->render();
    }
}