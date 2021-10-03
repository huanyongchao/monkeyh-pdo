<?php

namespace Monkeyhh\Command;

use Monkeyhh\Command\Base;
use Monkeyhh\Pdo\Mysql;
use Monkeyhh\Pdo\Model;

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

        $file_name1 = '0_migrate_init.sql';
        $fh = fopen(APP_ROOT . '/migrate/' . $file_name1, "w");
        $sql = "create table 0_migrate_init (
id serial PRIMARY key not null,
file_name VARCHAR (255),
file_name_md5 VARCHAR (100),
create_time integer
);
";
        $res_write = fwrite($fh, $sql);
        Mysql::execute($sql);

    }

    /**
     * @desc 测试项目
     */
    public function testSql()
    {
        $sql = "select * from schools";
        Mysql::getInstance(require_once(APP_ROOT.'config/db.php'));
        $schools = Mysql::get($sql,[],[]);
        var_dump($schools);

        echoLine($schools,'red');
        Mysql::getInstance(require_once(APP_ROOT.'config/db.php'));
        $school_first = Mysql::first($sql,[],[]);
        echoLine($school_first,'red');
    }

    /**
     * @param array $argvs ['name']
     */
    public function create($argvs = [])
    {
        $desc = $argvs[0];
        $file_name = date("Y-m-d") . '-' . time() . "-migreate-$desc.sql";
        $fh = fopen(APP_ROOT . '/migrate/' . $file_name, "w");
        $res_write = fwrite($fh, '');
        fclose($fh);
        return true;
    }

    /**
     * @desc 执行mysql文件
     */
    public function run()
    {
        $dir_path = APP_ROOT . 'migrate/';

        if (!is_dir($dir_path) && echoLine($dir_path, ' is not exist!', 'red')) {
            return false;
        }

        $handle = opendir($dir_path);

        while (($fl = readdir($handle)) !== false) {
            //查找
            if ($fl == '.' || $fl == '..') continue;
            $hit_sql = "select * from 0_migrate_init where file_name_md5 = " . md5($fl);

            $hit_sql_res = Mysql::get($hit_sql, []);

            //过滤
            if ($hit_sql_res) continue;

            $sql = file_get_contents($dir_path . $fl);

            $sql = "create table crm_ddd (
id serial PRIMARY key not null,
file_name VARCHAR (255),
file_name_md5 VARCHAR (100),
create_time integer
);";

            $sql_res = Mysql::execute($sql);

            if(!$sql_res) {
                echoLine('execute error','red');
                continue;
            }

            //执行插入
            $insert_sql = "insert into 0_migrate_init(`file_name`,`file_name_md5`,`create_time`) values(?,?,?)";
            $insert_res = Mysql::insert($insert_sql, [$fl, md5($fl), time()]);
            if (empty($insert_res)) {
                echoLine('execute sql:'.$insert_sql,' :is error','red');
            }
        }
    }

}