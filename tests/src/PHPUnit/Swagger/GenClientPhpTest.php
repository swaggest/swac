<?php

namespace Swac\Tests\PHPUnit\Swagger;

use Swac\Go\Client\Client;
use Swac\Log;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;

class GenClientPhpTest extends \PHPUnit_Framework_TestCase
{

    public function testUber()
    {
        $rest = new Rest();

        $phpClient = new \Swac\Php\Client\Client('Swac\Example\Uber', './');
        $rest->addRenderer($phpClient);

        $reader = new Reader($rest);
        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson(file_get_contents(__DIR__ . '/../../../resources/uber.json'));

        $reader->process();

        $srcPath = __DIR__ . '/../../../../examples/php-client/Uber/';
        $phpClient->store($srcPath);
        exec('git diff ' . $srcPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        $rest = new Rest();

        $phpClient = new \Swac\Php\Client\Client('Swac\Example\Petstore', './');
        $rest->addRenderer($phpClient);

        $reader = new Reader($rest);
        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson(file_get_contents(__DIR__ . '/../../../resources/petstore-expanded.json'));

        $reader->process();

        $srcPath = __DIR__ . '/../../../../examples/php-client/Petstore/';
        $phpClient->store($srcPath);
        exec('git diff ' . $srcPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

}