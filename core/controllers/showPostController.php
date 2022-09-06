<?php namespace core\controllers;
use core\app\Application;
use core\models\showPostModel;
class showPostController extends abstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new showPostModel();
        $this->data["model"] = $this->model;
        $this->data["title"] = "showPost";
        $this->data["links"] = [
            "css" => ["showPost"],
            "js" => ["showPost"]
            ];
    }
    public function showPost()
    {
        if($this->request->method() == "GET")
        {
            $loggedUserId = Application::$app->session->userId;
            $data = $this->request->getBody();
            $PostId = $this->request->get("postId") ? filter_var($this->request->get("postId"),FILTER_SANITIZE_NUMBER_INT) : null;
            if($PostId)
            {
              
              $this->data['loggedUserId'] = $loggedUserId;
              $this->data['user_posts'] = $this->model->fetchPostsById($PostId , $loggedUserId);

            }else
            {
                echo "sorry this Post not found";
            } 
        }
        $this->response->renderView("/showPost", $this->data);
    }
}