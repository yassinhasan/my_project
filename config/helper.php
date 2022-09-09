<?php

if(!function_exists("pre"))
{
    /**
     *  functio to print variables in pretty format
     *  @param variable $var
     *  @return void
     */
    function pre($var)
    {
        
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
} 

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
