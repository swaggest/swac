<?php

namespace Swac\Tests\PHPUnit\Swagger;

use Swac\Command\PhpGuzzleClient;

class GenClientPhpTest extends \PHPUnit_Framework_TestCase
{

    public function testUber()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schema = __DIR__ . '/../../../resources/uber.json';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/Uber/';
        $cmd->namespace = 'Swac\Example\Uber';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schema = __DIR__ . '/../../../resources/petstore-expanded.json';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/Petstore/';
        $cmd->namespace = 'Swac\Example\Petstore';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testAcme()
    {
        $cmd = new PhpGuzzleClient();
        $cmd->schema = __DIR__ . '/../../../resources/acme.json';
        $cmd->projectPath = __DIR__ . '/../../../../examples/php-guzzle-client/Acme/';
        $cmd->namespace = 'Swac\Example\Acme';

        $cmd->performAction();

        exec('git diff ' . $cmd->projectPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

}