<?php

namespace Swac;


use Bramus\Monolog\Formatter\ColoredLineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    private static $logger;

    /**
     * @return Logger
     */
    public static function getInstance()
    {
        if (self::$logger === null) {
            $log = new Logger('SWAC');
            $handler = new StreamHandler('php://stdout', Logger::DEBUG);
            $handler->setFormatter(new ColoredLineFormatter());
            $log->pushHandler($handler);
            self::$logger = $log;
        }

        return self::$logger;
    }

}