<?php
namespace core\controllers;

use core\app\Application;

class authenticateController extends abstractController

{
    public static function isLogged()
    {
        if(Application::$app->session->userId != null OR array_key_exists("loginCode" , $_COOKIE))
        {
            return true;
        }else
        {
            return false;
        }
       
    }
}