<?php


namespace Monkeyhh\Command;


interface BaseMigrate
{
    public function down();

    public function up();
}