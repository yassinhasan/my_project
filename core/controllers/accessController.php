<?php

namespace core\controllers;

use core\app\Application;
use core\controllers\abstractController;


class accessController extends abstractController
{

    public $excpetions = [

        "/login",
        "/register",
        "/forgetPassword",
        "/resetPassword" , 
        "/updateNewPassword"
    ];
    public  function isLogged()
    {

        $currentPath = Application::$app->request->currentPath;
        $isLogged = authenticateController::isLogged();
        if (!in_array($currentPath, $this->excpetions) AND !$isLogged) {
            $this->response->redirect("/login");
        }
    }
}
