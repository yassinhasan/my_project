<?php
namespace core\controllers;
use core\app\Application;
use core\models\userPostsModel;
class userPostsController extends abstractController
{
      public function __construct()
    {
        parent::__construct();
        $this->model = new userPostsModel();
        $this->data['model'] = $this->model;
        $this->data["title"] = "userPosts";
        $this->data['links'] = [
            "css" => ["userPosts"] ,
            "js" => ["userPosts"] ,
        ];

    }
    public function userPosts()
    {
        if($this->request->method() == "GET")
        {
            $loggedUserId = Application::$app->session->userId;
            $data = $this->request->getBody();
            $userId = $this->request->get("id") ? filter_var($this->request->get("id"),FILTER_SANITIZE_NUMBER_INT) : null;
            if($userId)
            {
              
              $this->data['user'] = $this->model->getuserPostsInfo($userId , $loggedUserId);
              $this->data['user_posts'] = $this->model->fetchPostsById($userId ,  $loggedUserId);

            }else
            {
                echo "sorry this id not found";
            } 
        }
        $this->response->renderView("/userPosts", $this->data);
    }
}

