#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/init.php';
require_once __DIR__ . '/config/utils.php';
$request_start_at = time();

if($argc < 2) {
    echoLine('arguments error');
    echoLine('usage: php cli.php taskName actionName');
    echoLine('task list:');
}

use Monkeyhh\Pdo\Command\Command;
Command::init();

echoLine('process time: ' . sprintf('%0.3f', (microtime(true) - $request_start_at)) . 's');
