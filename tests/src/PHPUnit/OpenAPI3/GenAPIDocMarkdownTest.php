<?php

namespace Swac\Tests\PHPUnit\OpenAPI3;

use Swac\Command\App;
use Swac\Command\GoClient;
use Swac\Command\JavaScriptClient;
use Swac\Command\Markdown;
use Swac\ExitCode;
use Swac\Markdown\APIDoc;

class GenAPIDocMarkdownTest extends \PHPUnit_Framework_TestCase
{

    public function testUspto()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/uspto.yaml';
        $cmd->out = __DIR__ . '/../../../../examples/uspto-oas3.md';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/petstore-expanded.yaml';
        $cmd->out = __DIR__ . '/../../../../examples/petstore-oas3.md';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testAdvanced()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/advanced3.json';
        $cmd->out = __DIR__ . '/../../../../examples/advanced-oas3.md';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testXhprofCollector()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/xhprof-collector.json';
        $cmd->out = __DIR__ . '/../../../../examples/xhprof-collector.md';
        $cmd->typesPrefix = 'xh';
        $cmd->addSchemaUrl = './openapi.json';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testFooBar()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/foobar.json';
        $cmd->out = __DIR__ . '/../../../../examples/foobar-oas3.md';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testEmpty()
    {
        App::$ver = '<version>';
        $cmd = new Markdown();
        $cmd->schema = __DIR__ . '/../../../resources/empty.json';
        $cmd->out = __DIR__ . '/../../../../examples/empty.md';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }
}