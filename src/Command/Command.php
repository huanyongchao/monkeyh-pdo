<?php


namespace Monkeyhh\Pdo\Command;

use Monkeyhh\Pdo\Command\Style;
use Monkeyhh\Pdo\Command\Output;

class Command
{
    private $name;
    private $version;

    private static $_instance = null;

    /**@var Output */
    private $out_handle = null;

    private $command_options = [
        'title' => 'Commands',
        'content' => [
            ['migrate', 'mysql migrate,you can use php migrate -help to learn more'],
            ['model', 'some edit for model,you can use -help to learn more'],
        ]
    ];

    private $command = ['migrate'];

    private $options = [
        'title' => 'Options',
        'content' => [
            ['-v', '--version', 'Display this command version'],
            ['-h', '--help', 'Display this help order version'],
            ['-m', '--version', 'Display this command version'],
            ['-d', '--describe', 'Display this describe，Display this describeDisplay this describeDisplay this describeDisplay this describeDisplay this describe'],
            ['-o', '--options', 'Options'],
        ]
    ];

    public function __construct()
    {
        $this->out_handle = new Output();
    }

    /**
     * 获取实例
     * @return Command|null
     */
    public static function getInstance()
    {
        self::$_instance = empty(self::$_instance) ? new self() : self::$_instance;
        return self::$_instance;
    }

    /**
     * 初始化 Command
     * @return bool
     */
    public static function init()
    {

        $argvs = $_SERVER['argv'];
        if (count($argvs) < 2) {
            self::getInstance()->showList();
        } else {
            self::getInstance()->run($argvs);
        }
        return true;
    }

    /**
     * @param array $argvs
     */
    private function run($argvs = [])
    {
        try {

            /*doRun 执行方法*/
            $command = $argvs[1];
            $class_name = "\Monkeyhh\Command\\".ucfirst($command);
            $ss = $class_name::init($argvs);

        } catch (\Exception $e) {

        }
    }

    /**
     * 显示当前commands[]
     */
    private function showList()
    {
        try {
            $this->out_handle->outOptions($this->options);
            $this->out_handle->outOptions($this->command_options);
        } catch (\Exception $e) {

        }
    }


}