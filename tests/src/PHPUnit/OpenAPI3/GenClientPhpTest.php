<?php

namespace Swac\Tests\PHPUnit\OpenAPI3;


use Swac\Command\PhpGuzzleClient;

class GenClientPhpTest extends \PHPUnit_Framework_TestCase
{

    public function testUspto()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schemaPath = __DIR__ . '/../../../resources/uspto.yaml';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/UsptoOAS3/';
        $cmd->namespace = 'Swac\Example\UsptoOAS3';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schemaPath = __DIR__ . '/../../../resources/petstore-expanded.yaml';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/PetstoreOAS3/';
        $cmd->namespace = 'Swac\Example\PetstoreOAS3';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testFooBar()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schemaPath = __DIR__ . '/../../../resources/foobar.json';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/FooBarOAS3/';
        $cmd->namespace = 'Swac\Example\FooBarOAS3';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

}