<?php

namespace Monkeyhh\Pdo;

/**
 * Class Model
 * @package Monkeyhh\Pdo
 * @method static Model find()
 */
class Model extends Mysql
{
    public static $_table_name = '';
    public static $_prefix = '';

    public static $_order = '';

    public static function __callStatic($func, $arguments)
    {
        self::$_order = $func;
    }

    /**
     * 获取全表名字
     * @return string
     */
    static function getTable()
    {
        //获取表名
        $class = get_called_class();
        if (!empty($class::$_table_name)) {
            $table = $class::$_table_name;
        } else {
            $model_names = explode('\\', $class);
            $model_name = end($model_names);
            $table = $class::$_prefix . lcfirst($model_name);
        }
        return $table;
    }

    public static function config($config)
    {
        parent::getInstance($config);
    }

    public function afterUpdate()
    {

    }

    public function beforeUpdate()
    {

    }
}
