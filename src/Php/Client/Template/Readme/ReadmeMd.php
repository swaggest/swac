<?php

namespace Swac\Php\Client\Template\Readme;

use Swac\Rest\Parameter;
use Swac\Php\Client\Template\OperationClass;
use Swac\Php\Client\Template\Response\Info;
use Swaggest\CodeBuilder\AbstractTemplate;
use Swaggest\CodeBuilder\Markdown\Table;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\JsonSchema\PhpBuilder;
use Swaggest\PhpCodeBuilder\PhpAnyType;
use Swaggest\PhpCodeBuilder\PhpClass;
use Swaggest\PhpCodeBuilder\Types\ArrayOf;
use Swaggest\PhpCodeBuilder\Types\OrType;
use Swaggest\PhpCodeBuilder\Types\TypeOf;

class ReadmeMd extends AbstractTemplate
{
    /** @var OperationClass[] */
    private $operationClasses = [];

    private $classes = [];

    public function addHandler(OperationClass $handlerClass)
    {
        $this->operationClasses[] = $handlerClass;
        return $this;
    }

    private function renderType(PhpAnyType $type)
    {
        switch (true) {
            case $type instanceof ArrayOf:
                return $this->renderType($type->getType()) . '[]';
            case $type instanceof OrType:
                $result = '';
                foreach ($type->simplify()->getTypes() as $typeItem) {
                    $result .= '&#124;' . $this->renderType($typeItem);
                }
                return substr($result, 6);
            case $type instanceof PhpClass:
                $this->addRenderClass($type);
                $anchor = strtolower($type->getFullyQualifiedName());
                $anchor = str_replace('\\', '', $anchor);
                return '[`' . $type->getName() . '`](#' . $anchor . ')';
            default:
                return '`' . $type->renderPhpDocType() . '`';
        }
    }

    private function renderClass(PhpClass $class)
    {
        $result = '#### ' . $class->getFullyQualifiedName();
        if (empty($class->getProperties())) {
            $importType = $class->getMeta(PhpBuilder::IMPORT_TYPE);
            return $result . "\n" . $this->renderType($importType);
        }

        $rows = [];
        foreach ($class->getProperties() as $property) {
            /** @var Schema $schema */
            $schema = $property->getMeta(PhpBuilder::SCHEMA);

            $name = $property->getNamedVar()->getName();
            $type = $this->renderType($property->getNamedVar()->getType());

            $r = [
                'Name' => '`' . $name . '`',
                'Type' => $type,
            ];
            if ($schema->description) {
                $r['Description'] = str_replace("\n", '<br>', trim($schema->description));
            }

            $rows[] = $r;
        }

        return $result . "\n" . new Table($rows);

    }

    private function addRenderClass(PhpClass $class)
    {
        $fqn = $class->getFullyQualifiedName();

        if (array_key_exists($fqn, $this->classes)) {
            return;
        }

        $this->classes[$fqn] = null;

        $this->classes[$fqn] = $this->renderClass($class);
    }

    private function renderRequest(PhpAnyType $request)
    {
        $requestType = new TypeOf($request);
        $requestStructure = '';
        $requestBody = '';
        if ($request instanceof PhpClass) {
            $rows = [];
            foreach ($request->getProperties() as $property) {
                /** @var Schema $schema */
                $schema = $property->getMeta(PhpBuilder::SCHEMA);
                $param = $schema->getMeta(Parameter::class);
                $in = $param->in ? $param->in : Parameter::BODY;
                $type = $property->getNamedVar()->getType();
                if ($type instanceof PhpClass) {
                    $this->addRenderClass($type);
                }
                $rows[] = [
                    'Name' => '`' . $property->getNamedVar()->getName() . '`',
                    'Type' => $this->renderType($type),
                    'In' => '`' . $in . '`',
                    'Description' => str_replace("\n", '<br>', trim($param->description))
                ];
                if ($in === Parameter::BODY) {
                    if ($type instanceof PhpClass) {
                        $requestBody = $this->renderClass($type);
                    }
                }
            }
            $requestStructure = (string)new Table($rows);
            if ($requestStructure) {
                $requestStructure = "\n\n" . $requestStructure;
            }
        }

        return <<<MARKDOWN
#### Request
Type: `{$requestType}`{$requestStructure}

{$requestBody}

MARKDOWN;
    }

    /**
     * @param Info[] $resultMap
     * @return string
     */
    private function renderResponse($resultMap)
    {
        $rows = [];
        $result = '#### Response' . "\n";
        if ($resultMap) {
            foreach ($resultMap as $info) {
                $rows[] = [
                    'Status' => $info->statusCode . ' ' . $info->statusPhrase,
                    'Type' => $info->type ? $this->renderType($info->type) : '',
                    'Description' => str_replace("\n", '<br>', trim($info->response->description))
                ];
            }
        }
        $res = (string)new Table($rows);
        if ($res) {
            $result .= "\n\n" . $res;
        }

        return $result;
    }

    private function renderOperationClass(OperationClass $handlerClass)
    {
        $handlerDesc = wordwrap($handlerClass->getOperation()->description);
        $request = $handlerClass->getRequestType();
        $resultMap = $handlerClass->getResponseCodeFactory()->getResultInfo();

        return <<<MARKDOWN
### `{$handlerClass->getName()}`

{$handlerDesc}

_Endpoint_: `{$handlerClass->getOperation()->path}`

_Namespace_: `{$handlerClass->getNamespace()}`

{$this->renderRequest($request)}

{$this->renderResponse($resultMap)}

MARKDOWN;

    }

    private function renderTableOfContents()
    {
        $list = [];

        foreach ($this->operationClasses as $handlerClass) {
            $handler = $handlerClass->getOperation();

            $listItem = '* [`' . $handler->getMethodUppercase() . ' ' . $handler->path . '`](#'
                . strtolower($handlerClass->getName()) . ')'
                . ' ' . $handler->getSummaryOrDescription();
            if ($handler->tags) {
                foreach ($handler->tags as $tag) {
                    $list[$tag][] = $listItem;
                }
            } else {
                $list[''][] = $listItem;
            }
        }

        $result = '';
        ksort($list);
        foreach ($list as $tag => $items) {
            asort($items);
            $items = implode("\n", $items);
            $result .= <<<MD
### $tag

$items


MD;

        }

        return $result;
    }

    private function renderOperationClasses()
    {
        $handlerDocs = '';

        foreach ($this->operationClasses as $handlerClass) {
            $handlerDocs .= $this->renderOperationClass($handlerClass);
        }

        return $handlerDocs;
    }

    private function renderClasses()
    {
        $result = '';
        if ($this->classes !== null) {
            ksort($this->classes);
            foreach ($this->classes as $name => $info) {
                $result .= $info . "\n";

            }
        }
        return $result;
    }

    protected function toString()
    {
        $result = <<<MD
# API

{$this->renderTableOfContents()}

## Operations

{$this->renderOperationClasses()}

## Structures

{$this->renderClasses()}

MD;

        return $result;
    }
}