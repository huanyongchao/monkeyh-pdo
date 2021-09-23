<?php

namespace Monkeyhh\Command;

use Monkeyhh\Command\Base;

class Migrate extends Base
{
    /**
     * @desc 初始化项目
     */
    public function init()
    {
        if (!is_dir(APP_ROOT . '/migrate/')) {
            mkdir(APP_ROOT . '/migrate/');
        }

        $file_name1 = '00000000000_migrate_init.php';
        $fh = fopen(APP_ROOT . '/migrate/' . $file_name1, "w");
        $content = "";
        $res_write = fwrite($fh, $content);
    }


    /**
     * @param array $argvs ['order']
     */
    public function create($argvs = [])
    {

    }

    public function migrate()
    {

    }

}