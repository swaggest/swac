<?php

namespace Swac\Markdown;

use Swac\Command\App;
use Swac\Rest\Config;
use Swac\Rest\Operation;
use Swac\Rest\Renderer;
use Swaggest\CodeBuilder\AbstractTemplate;
use Swaggest\CodeBuilder\TableRenderer;
use Swaggest\GoCodeBuilder\Templates\Code;
use Swaggest\JsonSchema\Schema;
use Swaggest\PhpCodeBuilder\Markdown\TypeBuilder;
use Swaggest\PhpCodeBuilder\PhpCode;

class APIDoc extends AbstractTemplate implements Renderer
{
    /**
     * @var TypeBuilder
     */
    public $markdownTypes;

    /** @var string[] */
    private $operationNames;

    /** @var string */
    public $addSchemaUrl = '';

    /** @var Code */
    private $document;

    /** @var Code */
    private $tableOfContents;

    /** @var Code[] */
    private $taggedContents = [];

    public function __construct()
    {
        $ver = App::$ver;

        $this->markdownTypes = new TypeBuilder();
        $this->markdownTypes->trimNamePrefix[] = '#/components/schemas';

        $head = <<<MD
<!-- Code is generated by github.com/swaggest/swac $ver, DO NOT EDIT. 🤖 -->


MD;

        $this->document = new Code();
        $this->tableOfContents = new Code(<<<MD
## Table Of Contents


MD
        );

        $this->document->addSnippet($head);
    }

    public function setConfig(Config $config)
    {
        $headComment = '';
        if (isset($config->version) && !empty(trim($config->version))) {
            $headComment .= 'Version: ' . trim($config->version) . "\n\n";
        }
        if (isset($config->description) && !empty(trim($config->description))) {
            $headComment .= trim(wordwrap($config->description)) . "\n\n";
        }
        if (isset($config->baseUrl) && !empty(trim($config->baseUrl))) {
            $headComment .= 'Base URL:' . trim(wordwrap($config->baseUrl)) . "\n\n";
        }
        if (isset($this->addSchemaUrl) && !empty($this->addSchemaUrl)) {
            $headComment .= '[Schema](' . $this->addSchemaUrl . ').' . "\n\n";
        }

        $title = empty($config->title) ? 'API Documentation' : $config->title;


        $this->document->addSnippet(<<<MD
# {$title}

{$headComment}


MD
        );

        $this->document->addSnippet($this->tableOfContents);

        if (!empty($config->apiKeySecurityList)) {
            $this->tableOfContents->addSnippet(<<<MD
* [Security](#security)

MD
            );

            $this->document->addSnippet(<<<MD

## <a id="security"></a>Security


MD
            );
            foreach ($config->apiKeySecurityList as $security) {
                $ln = strtolower($security->name);
                $prefix = empty($security->paramValuePrefix) ? '' : "Value prefix: `$security->paramValuePrefix`.\n";
                $this->document->addSnippet(<<<MD
### <a id="$ln"></a> {$security->name}
{$security->description}

In: `{$security->paramIn}`.
Name: `{$security->paramName}`.
{$prefix}

MD
                );
            }
        }

        $this->document->addSnippet(<<<MD

## <a id="operations"></a>Operations


MD
        );
        $this->tableOfContents->addSnippet(<<<MD
* [Operations](#operations)

MD
        );

    }

    private function uppercase($s)
    {
        return strtoupper($s);
    }

    private function lowercase($s)
    {
        return strtolower($s);
    }

    private function schemaHash($schema)
    {
        if ($schema === null) {
            return '';
        }

        $markdownTypes = new TypeBuilder();
        $markdownTypes->trimNamePrefix[] = '#/components/schemas';

        $res = $markdownTypes->renderTypeDef($schema, 'any', '#');

        return md5($res);
    }

    private $hashByPath = [];

    private function typeName($schema, $path = '#')
    {
        $hash = $this->schemaHash($schema);
        $path0 = $path;
        $i = 2;
        while (isset($this->hashByPath[$path]) && $this->hashByPath[$path] !== $hash) {
            $path = $path0 . $i;
            $i++;
        }

        $this->hashByPath[$path] = $hash;

        return $this->markdownTypes->getTypeString($schema, $path);
    }

    private function ifTrue($cond, $s)
    {
        if ($cond) {
            return $s;
        }

        return '';
    }

    public function addOperation(Operation $operation)
    {
        $funcName = '';
        if ($operation->operationId !== null) {
            $funcName = strtolower($this->makeName($operation->operationId));
        }

        if (empty($funcName) || isset($this->operationNames)) {
            $funcName = $this->makeName($operation->method . '_' . $operation->path);
        }

        $security = '';
        if (!empty($operation->security)) {
            foreach ($operation->security as $item) {
                foreach ($item as $securityName => $scopes) {
                    $security .= "[`$securityName`](#{$this->lowercase($securityName)}), ";
                }
            }

            if (!empty($security)) {
                $security = 'Security: ' . substr($security, 0, -2) . ".\n";
            }
        }

        if (!empty($operation->tags)) {
            foreach ($operation->tags as $tag) {
                if (!isset($this->taggedContents[$tag])) {
                    $this->taggedContents[$tag] = new Code();
                }

                $this->taggedContents[$tag]->addSnippet(<<<MD
      - [{$this->uppercase($operation->method)} `{$operation->path}`](#{$this->lowercase($funcName)}) {$operation->summary}

MD
                );
            }
        } else{
            $this->tableOfContents->addSnippet(<<<MD
  - [{$this->uppercase($operation->method)} `{$operation->path}`](#{$this->lowercase($funcName)}) {$operation->summary}

MD
            );
        }


        $this->document->addSnippet(<<<MD
### <a id="{$this->lowercase($funcName)}"></a>{$this->uppercase($operation->method)} `{$operation->path}`
{$operation->summary}

{$operation->description}

{$security}

{$this->ifTrue(!empty($operation->contentType), "Request content type: `{$operation->contentType}`.")}

MD
        );


        $this->operationNames[$funcName] = true;

        if (!empty($operation->parameters)) {
            $this->document->addSnippet(<<<MD
#### Parameters


MD
            );

            $rows = [];
            foreach ($operation->parameters as $parameter) {
                $examples = '';
                if (!empty($parameter->examples)) {
                    foreach ($parameter->examples as $example) {
                        $examples .= '`' . (is_string($example) ? $example : json_encode($example)) . '`' . '<br>';
                    }

                    $examples = substr($examples, 0, -4);
                }

                $rows [] = [
                    'Name' => '`' . $parameter->name . '`',
                    'In' => $parameter->in,
                    'Type' => $this->typeName($parameter->schema, $parameter->name),
                    'Description' => str_replace(["\r\n", "\n"], '<br>', $parameter->description),
                    'Examples' => $examples
                ];
            }

            $this->document->addSnippet(TableRenderer::create(new \ArrayIterator($rows))
                ->stripEmptyColumns()
                ->setColDelimiter('|')
                ->setHeadRowDelimiter('-')
                ->setOutlineVertical(true)
                ->setShowHeader());

        }

        if (!empty($operation->responses)) {
            $this->document->addSnippet(<<<MD

#### Response


MD
            );

            $rows = [];

            foreach ($operation->responses as $response) {
                $headers = '';
                if (!empty($response->headers)) {
                    foreach ($response->headers as $name => $schema) {
                        $headers .= "`$name`: {$this->typeName($schema, $name)}<br>";
                    }
                    if (!empty($headers)) {
                        $headers = substr($headers, 0, -4);
                    }
                }
                $status = $response->isDefault ? 'default' : $response->statusCode;

                $rows [] = [
                    'Status' => $status,
                    'Content Type' => $response->contentType ? '`' . $response->contentType . '`' : '',
                    'Body Type' => $this->typeName($response->schema, $funcName . '/response/' . $status),
                    'Headers' => $headers,
                    'Description' => $response->description,
                ];
            }

            $this->document->addSnippet(TableRenderer::create(new \ArrayIterator($rows))
                ->stripEmptyColumns()
                ->setColDelimiter('|')
                ->setHeadRowDelimiter('-')
                ->setOutlineVertical(true)
                ->setShowHeader());

        }
    }

    private function makeName($s)
    {
        return PhpCode::makePhpName($s);
    }

    public function store($path)
    {
        foreach ($this->taggedContents as $tag => $content) {
            $this->tableOfContents->addSnippet(<<<MD
    * $tag
{$content}

MD
            );
        }

        $this->tableOfContents->addSnippet(<<<MD
* [Types](#types)

MD
        );

        $this->document->addSnippet(<<<MD

## <a id="types"></a> Types


MD
        );
        $this->document->addSnippet($this->markdownTypes->file);

        $result = $this->document->render();

        $result = preg_replace("/[\r\n]{2,}/", "\n\n", $result);

        file_put_contents($path, $result);
    }

    protected function toString()
    {
    }
}