<?php

namespace Monkeyhh\Command;

use Monkeyhh\Command\Base;

/**
 * Class Command
 * @package  Monkeyhh\Command
 * @desc class for edit cli class
 * @author jack
 * @copyright 20210924
 */
class Command extends Base
{

    /**
     * @param array $params
     * @return bool
     * @desc 创建command
     */
    public function create($params = [])
    {
        $class_name = $params[0];

        $desc = isset($params[1]) ? $params[1] : 'desc is empty';
        $file_name = APP_ROOT . '/cli/command/' . ucfirst($class_name) . '.php';
        if (file_exists($file_name)) {
            throw new \RuntimeException("error::class is exist!");
        }
        $fh = fopen($file_name, "w");
        $content =
            "<?php

namespace Monkeyhh\Command;

use Monkeyhh\Command\Base;

/**
 * Class $class_name
 * @package  Monkeyhh\Command
 * @desc $desc
 * @author jack
 * @copyright 20210924
 */
class $class_name extends Base
{

}";
        fwrite($fh, $content);
        fclose($fh);
        return true;
    }

    public function add()
    {

    }

}