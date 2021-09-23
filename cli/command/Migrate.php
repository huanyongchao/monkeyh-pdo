<?php
namespace Monkeyhh\Command;

use Monkeyhh\Command\Base;
class Migrate implements Base
{
    public function __construct()
    {

    }

    /**
     * @desc 初始化项目
     */
    public static function init(array $argvs)
    {

        if(!is_dir(APP_ROOT.'/migrate/')) {
            mkdir(APP_ROOT.'/migrate/');
        }

        $file_name1 = date("Y-m-d").'__monkey_init.php';
        $fh = fopen(APP_ROOT.'/migrate/'.$file_name1, "w");
        $content = "<?php

namespace Monkeyhh\Command;

use Monkeyhh\Command\BaseMigrate;

class BaseMigrateSimple implements BaseMigrate
{
    public function up()
    {
        // TODO: Implement up() method.
    }

    public function down()
    {
        // TODO: Implement down() method.
    }
}";
        $fwrite = fwrite($fh,$content);
    }

    public function migration()
    {

    }

    public function migrate()
    {

    }

}