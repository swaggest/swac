<?php

namespace Swac\Tests\PHPUnit\Swagger;

use Swac\Command\GoClient;

class GenClientGoTest extends \PHPUnit_Framework_TestCase
{

    public function testUber()
    {
        $cmd = new GoClient();
        $cmd->schemaPath = __DIR__ . '/../../../resources/uber.json';
        $cmd->out = __DIR__ . '/../../../../examples/go-client/uber/';
        $cmd->pkgName = 'uber';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        $cmd = new GoClient();
        $cmd->schemaPath = __DIR__ . '/../../../resources/petstore-expanded.json';
        $cmd->out = __DIR__ . '/../../../../examples/go-client/petstore/';
        $cmd->pkgName = 'petstore';

        $cmd->performAction();

        exec('git diff ' . $cmd->out, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }


}