<?php

namespace Swac\Tests\PHPUnit\Swagger;

use Swac\Go\Client\Client;
use Swac\Log;
use Swac\Rest\Rest;
use Swac\Swagger\Reader;

class GenClientGoTest extends \PHPUnit_Framework_TestCase
{

    public function testUber()
    {
        $rest = new Rest();

        $goClient = new Client();
        $rest->addRenderer($goClient);

        $reader = new Reader($rest);
        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson(file_get_contents(__DIR__ . '/../../../resources/uber.json'));

        $reader->process();

        $srcPath = __DIR__ . '/../../../../examples/go-client/uber/';
        $goClient->store($srcPath, 'uber');
        exec('git diff ' . $srcPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }

    public function testPetstoreExpanded()
    {
        $rest = new Rest();

        $goClient = new Client();
        $rest->addRenderer($goClient);

        $reader = new Reader($rest);
        $reader->setLog(Log::getInstance());
        $reader->addSchemaJson(file_get_contents(__DIR__ . '/../../../resources/petstore-expanded.json'));

        $reader->process();

        $srcPath = __DIR__ . '/../../../../examples/go-client/petstore/';
        $goClient->store($srcPath, 'petstore');
        exec('git diff ' . $srcPath, $out);
        $out = implode("\n", $out);
        $this->assertSame('', $out, "Generated files changed");
    }


}