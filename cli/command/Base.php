<?php

namespace Monkeyhh\Command;

use Monkeyhh\Pdo\Command\Output;

/**
 * Class Base
 * @package Monkeyhh\Command
 */
class Base
{
    private $_class_name = '';
    private $_func_name = '';
    private $_argvs = [];

    /**
     *
     * @param $argvs
     * @return mixed
     *
     */
    public function __construct(array $argvs)
    {
        $this->_class_name = get_called_class();
        if (!isset($argvs[2])) {

            $this->outPut("[ERROR:::Do not forget input method]", '', '', 'red');
            $this->showDesc();

        } else {

            $this->_func_name = $argvs[2];

            if (!method_exists($this->_class_name, $this->_func_name)) {
                $this->outPut("[ERROR:::method is error,please input correct method name]", '', '', 'red');
                $this->showDesc();
            }

            $this->_argvs = array_slice($argvs, 3);
        }
    }

    /**
     *
     * exec command
     * @return bool
     *
     */
    public final function exec()
    {
        $func_name = $this->_func_name;

        if (method_exists($this->_class_name, $this->_func_name)) {
            $this->$func_name($this->_argvs);
        }
        return true;
    }

    /**
     *
     * show desc while function is not exists
     * @return bool
     *
     */
    public final function showDesc()
    {

        $reflection = new \ReflectionClass($this->_class_name);
        $class_doc = $reflection->getDocComment();
        if (preg_match_all("/@(.*)/i", $class_doc, $matchs)) {

            $this->outPut($this->_class_name, "", "", 'yellow');
            foreach ($matchs[0] as $doc_item) {
                $this->outPut($doc_item, "\t");
            }

        }

        $this->outPut('');

        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        foreach ($methods as $method) {
            //获取子类中方法
            $method_name = $method->getName();

            if ($method->class == $this->_class_name) {

                $method_doc = $method->getDocComment();

                if ($method_doc && preg_match_all("/@(.*)/i", $method_doc, $method_matchs)) {

                    $this->outPutLine($method_name, "\t__func__ ", '', 'green');

                    $this->outPutLine("(", '', '', 'green');
                    foreach ($method_matchs[1] as $key => $value) {

                        $line_arr = explode(' ', $value);
                        if ($line_arr[0] == 'param') {
                            //获取参数
                            $out_str = " " . $line_arr[1] . " " . $line_arr[2] . ", ";
                            $this->outPutLine($out_str, '', '', 'green');
                        }
                    }
                    $this->outPutLine(") ", '', '', 'green');

                    $this->outPut('');
                    foreach ($method_matchs[0] as $doc_item) {
                        $this->outPut($doc_item, "\t");
                    }

                } else {
                    $this->outPut($method_name, "\t__func__ ", '', 'green');
                }

                $this->outPut('');

            }

        }

    }

    /**
     * @param string $message
     * @param string $before_cut
     * @param string $end_cut
     * @param string $style
     */
    public final function outPut($message = '', $before_cut = '', $end_cut = '', $style = 'black')
    {
        Output::getInstance()->outPut($message, $before_cut, $end_cut, $style);
        return true;
    }

    /**
     * @param string $message
     * @param string $before_cut
     * @param string $end_cut
     * @param string $style
     */
    public final function outPutLine($message = '', $before_cut = '', $end_cut = '', $style = 'black')
    {
        Output::getInstance()->outPutLine($message, $before_cut, $end_cut, $style);
        return true;
    }
}