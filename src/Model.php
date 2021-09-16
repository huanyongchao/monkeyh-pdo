<?php
namespace Monkeyhh\Pdo;

/**
 * Class Model
 * @package Monkeyhh\Pdo
 */
class Model extends Mysql
{
    public static function config($config)
    {
        parent::getInstance($config);
    }
}
