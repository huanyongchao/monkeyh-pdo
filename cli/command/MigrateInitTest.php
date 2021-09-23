<?php


namespace Monkeyhh\Command\command;

use Monkeyhh\Command\BaseMigrate;

class MigrateInitTest implements BaseMigrate
{
    public function down()
    {
        $sql = "create table";
    }

    public function up()
    {

    }
}