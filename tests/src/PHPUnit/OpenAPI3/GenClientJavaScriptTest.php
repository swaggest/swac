<?php

namespace Swac\Tests\PHPUnit\OpenAPI3;

use Swac\Command\App;
use Swac\Command\GoClient;
use Swac\Command\JavaScriptClient;

class GenClientJavaScriptTest extends \PHPUnit_Framework_TestCase
{

    public function testUspto()
    {
        App::$ver = '<version>';
        $cmd = new JavaScriptClient();
        $cmd->schema = __DIR__ . '/../../../resources/uspto.yaml';
        $cmd->out = __DIR__ . '/../../../../examples/js-client/uspto-oas3/';
        $cmd->pkgName = 'uspto';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        App::$ver = '<version>';
        $cmd = new JavaScriptClient();
        $cmd->schema = __DIR__ . '/../../../resources/petstore-expanded.yaml';
        $cmd->out = __DIR__ . '/../../../../examples/js-client/petstore-oas3/';
        $cmd->pkgName = 'petstore';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testFooBar()
    {
        App::$ver = '<version>';
        $cmd = new JavaScriptClient();
        $cmd->schema = __DIR__ . '/../../../resources/foobar.json';
        $cmd->out = __DIR__ . '/../../../../examples/js-client/foobar-oas3/';
        $cmd->pkgName = 'foobar';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }
}