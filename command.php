<?php

$env = "development";
$tip = 'start ' . $env . ' environment. '  ;
$tip .= ' Ctrl + D or input "exit" to exit console shell.' . PHP_EOL;

echo $tip;
$promote = "XPhalcon@>";
$blocks = "";
while (true) {
    $line = readline($promote);

    if (false === $line) {

        break;
    }

    readline_add_history($line);

    if ("<?php" == $line) {
        $blocks = "";
        continue;
    }

    if ('exit' == $line) {
        break;
    }
    if ('clear' == $line){
        $blocks = "";
    }
    $blocks .= $line . PHP_EOL;

    if ("?>" == $line) {
        try {
            //echo $blocks.PHP_EOL;
            $start_at = microtime(true);
            eval($blocks);

            $execute_time = microtime(true) - $start_at;
            echo PHP_EOL. "execute time ". $execute_time. 'ms';

        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
        echo PHP_EOL;
    }


}

echo PHP_EOL;