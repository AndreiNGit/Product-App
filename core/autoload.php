<?php

function autoload($className)
{
    $arr = [
        'classes'
    ];

    foreach($arr as $path)
    {
        $file = sprintf("./core/%s/%s.php", $path, $className);
        if(is_file($file))
        {
            include_once $file;
        }
    }
}

spl_autoload_register("autoload");