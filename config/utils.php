<?php

/**
 * 是不是cli模式
 * @return bool
 */
function isCli()
{
    return php_sapi_name() == 'cli';
}

/**
 * 是不是简单基础类型(null, boolean , string, numeric)
 * @param $object
 * @return bool
 */
function isPrimary($object)
{
    return is_null($object) || is_bool($object) || is_string($object) || is_numeric($object);
}


/**
 * 转换字符串
 * @param $object
 * @return string
 */
function toString($object)
{
    if (isPrimary($object)) {
        return $object;
    }
    if (is_array($object)) {
        return json_encode($object, JSON_UNESCAPED_UNICODE);
    }
    if (method_exists($object, '__toString')) {
        return get_class($object) . '@{' . $object->__toString() . '}';
    }

    $reflection_object = new ReflectionObject($object);
    $properties = $reflection_object->getProperties();
    $values = array();
    foreach ($properties as $property) {
        if ($property->isStatic() || !$property->isPublic()) {
            continue;
        }
        $name = $property->getName();
        $value = $property->getValue($object);
        if (isPrimary($value)) {
            $values[$name] = $value;
        } elseif (is_array($value)) {
            $values[$name] = json_encode($value, JSON_UNESCAPED_UNICODE);
        } else {
            $values[$name] = '@' . get_class($value);
        }
    }

    return get_class($object) . '@{' . json_encode($values, JSON_UNESCAPED_UNICODE) . '}';


}

/**
 * 方便调试输出
 */
function echoLine()
{

    $message = '';
    foreach (func_get_args() as $item) {
        $message .= toString($item) . ' ';
    }

    $text = '[PID ' . getmypid() . ']' . date('Y-m-d H:i:s') . ' ' . $message;
    if (isCli()) {
        echo $text . PHP_EOL;
    } else {
        echo $text . '<br/>';
    }

}


/**
 * 获取环境变量
 * @param null $key
 * @param null $default_value
 * @return mixed|null
 */
function env($key = null, $default_value = null)
{
}


function info()
{

    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

    $file = str_replace(APP_ROOT, '', $trace[0]['file']);
    $line = $trace[0]['line'];

    if (isset($trace[1]['function'])) {
        $function = $trace[1]['function'];
    } else {
        $function = 'unknow';
    }

    $message = '[' . $file . ":" . $line . ' ' . $function . ']';
    foreach (func_get_args() as $item) {
        $message .= toString($item) . ' ';
    }


    if (isCli()) {
        echoLine('[INFO]' . date('Y-m-d H:i:s', time()) . ' ' . $message);
    } else {
    }
}

function debug()
{

}

function trace()
{

}