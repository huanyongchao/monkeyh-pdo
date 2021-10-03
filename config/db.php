<?php

//单个数据库服务器
return [
    'host' => '127.0.0.1',
    'port' => 3306,
    'dbname' => 'monkey',
    'options' => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES’GBK’;"],
    'username' => 'root',
    'password' => '123456',
];