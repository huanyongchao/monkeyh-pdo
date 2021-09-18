<?php

namespace Monkeyhh\Pdo;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerHandle {

    private static $_self = null;

    public static function getInstance()
    {

        if(empty(self::$_self)) {
            self::$_self = new self();
        }

        return self::$_self;

    }

    public static function test()
    {

        $log = new Logger('name');
        $log->pushHandler(new StreamHandler('logs/your.log', Logger::WARNING));

        $log->warning('Foo');

    }

}