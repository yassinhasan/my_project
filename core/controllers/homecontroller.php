<?php
namespace core\controllers;

use core\app\Application;
use core\models\postsModel;
class homecontroller extends abstractController
{


  public function __construct()
    {
        parent::__construct();
        $this->model = new postsModel();
        $this->data['model'] = $this->model;
        $this->data["title"] = "home";
        $this->data['links'] = [
            "css" => ["home"] ,
            "js" => ["home"] ,
        ];

    }
    public function home()
    {

        $this->response->renderView("/home" ,$this->data );
    }
    
    public function sharePosts()
    {
        
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {
            $data = $this->request->getBody();
            $rules = $this->model->rules();
            if ($this->validate->isValid( $this->model , $rules , $data) )
            {
                
                if ($this->model->savePost( $userId)) 
                {
                   $this->jData['posts'] = $this->model->fetchPosts($userId);
                   
                    $this->jData['success'] = "your post is shared ";
                }else
                {
                    $this->jData['sql_error'] = "sorry there is somthing error please try in another time";
                }
            }else
            {
                $this->jData['errors'] =  $this->validate->getErrors();
            }
            $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
        public function fetchPosts()
    {
        
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {

             $this->jData['posts'] = $this->model->fetchPosts($userId);
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    // users
    
    public function fetchUsers()
    {
        
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {

             $this->jData['users'] = $this->model->fetchUsers($userId);
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
}