<?php
namespace core\controllers;

use core\app\Application;
use core\models\postsModel;
use core\app\user;
class homecontroller extends abstractController
{

    
    
  public function __construct()
    {
        
        parent::__construct();
        $this->model = new postsModel();
        $this->data['model'] = $this->model;
        $this->data["title"] = "home";
        $this->data['links'] = [
            "css" => [ "home/users","home/mediaquery" ,"home" ] ,
            
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
    public function fetchUpdateUserFollowSystem()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $status = $data['followStatus'];
        $followerId = $data['followerId'];
        if($this->request->method() == "POST")
        {
             if($this->model->fetchUpdateUserFollowSystem($userId , $followerId , $status))
             {
                $this->jData['update_user'] = "true";
             }
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    public function addComment()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $postId = $data['postId'];
        $comment = $data['comment'];
        if($this->request->method() == "POST")
        {
             if($this->model->addComment($userId , $postId , $comment) )
             {
               $xdata['userId'] = $userId;
               $xdata["userName"] = user::displayName();
               $this->pusher->trigger( $_ENV['CHANNEL'], 'addComment',  $xdata);
               $this->jData["comment"] = $this->model->fetchComments( $postId);
             }
      
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
     public function fetchComments()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $postId = $data['postId'];
        if($this->request->method() == "POST")
        {
             $this->jData["comment"] = $this->model->fetchComments( $postId);
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    // likes
        public function addLike()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $postId = $data['postId'];
        $type = $data['likeType'];
       
        if($this->request->method() == "POST")
        {
             if($this->model->addLike($userId , $postId , $type) )
             {
               $this->jData["likes"] = $this->model->fetchLikes( $postId);
             }
      
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    public function fetchLikes()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $postId = $data['postId'];
        if($this->request->method() == "POST")
        {
             $this->jData["likes"] = $this->model->fetchLikes($postId);
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
}