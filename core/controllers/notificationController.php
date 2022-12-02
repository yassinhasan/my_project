<?php namespace core\controllers;
use core\app\Application;
use core\models\notificationModel;
class notificationController extends abstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new notificationModel();
        $this->data["model"] = $this->model;
        $this->data["title"] = "notification";
        $this->data["links"] = [
            "css" => ["notification"],
            "js" => ["notification"],
        ];
    }
    // public function notification()
    // {
    //     $this->response->renderView("/notification", $this->data);
    // }
    
    public function getNotifications()
    {
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {
          $this->jData["notification"] = $this->getNotifications($userId);
          $this->json(); 
        }
    }
}
