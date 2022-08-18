<?php
namespace core\controllers;

use core\app\Router;
use core\app\Application;

class abstractController
{
    protected $response;
    protected $request;
    protected $session;
    protected $customExceptions;
    protected $cookie;
    protected $data = [];
    protected $model = null;
    protected $jData = [];
    protected $pusher;
    public function __construct()
    {
        $this->response =   Application::$app->response;
        $this->request =   Application::$app->request;
        $this->validate =   Application::$app->validate;
        $this->session =   Application::$app->session;
        $this->cookie =   Application::$app->cookie;
        $this->customExceptions =   Application::$app->customExceptions;
        $this->pusher = Application::$app->pusher;
    }

    public function json()
    {
      echo   json_encode($this->jData , JSON_PRETTY_PRINT);
      
    }
}