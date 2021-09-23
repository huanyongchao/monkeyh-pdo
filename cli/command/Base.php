<?php

namespace Monkeyhh\Command;

interface Base
{
    /**
     * @param $argvs
     * @return mixed
     */
    public static function init(array $argvs);

}