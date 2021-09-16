<?php
namespace Monkeyhh\PDO;

/**
 * Class Model
 * @package Monkeyhh\PDO
 */
class Model extends Mysql
{
    public static function config($config)
    {
        parent::getInstance($config);
    }
}
