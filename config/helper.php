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
 