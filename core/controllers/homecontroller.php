<?php
namespace core\controllers;

use core\app\Application;
use core\models\postsModel;
use core\models\notificationModel;
use core\app\user;
use core\app\uploadImage;
use core\app\uploadVideo;
use core\app\uploadDocs;
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
            
            "js" => ["mypusher","home"] ,
        ];

    }
    public function home()
    {
        if($this->request->method() == "POST")
        {
            $id = Application::$app->session->userId;;
            $this->jData["loggedUser"] = $id;
          // echo  $this->pusher->socket_auth($_POST["channel_name"],  $socket_id);
           $Pusherdata["userId"] = $id;
           $Pusherdata["onlineStatus"] = STATUS_ONLINE;
                        //  $this->pusher->socket_auth($_POST["channel_name"],  $socket_id);
           $this->pusher->trigger( $_ENV['CHANNEL'], 'isLogged',  $Pusherdata);
            $this->json(); 
        }else 
        {
        $this->response->renderView("/home" ,$this->data );
        }
    }
    public function updateLastActivity()
    {
      if($this->request->method() == "POST")
        {
            $userId = Application::$app->session->userId;
            if($this->model->updateLastActivity($userId))
            {
                $this->jData["succ"] = "updated";
            }

            $this->json(); 
        }else 
        {
        $this->response->renderView("/home" ,$this->data );
        }
    }
    public function getNotifications()
    {
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {
           $notificationModel = new notificationModel();
          $this->jData["notification"] = $notificationModel->getNotifications($userId);
          $this->json(); 
        }
    }
    public function presenceAuth()
    {
         $presence_data = [];
         $loggedUser = user::findUser();
        
         $socket_id = $_POST["socket_id"];
         $presence_data = ['user_id' => $loggedUser->id , "info" => $loggedUser];
         $d = json_encode($presence_data);
        // $this->pusher->trigger( $_ENV['CHANNEL'], 'subscription_succeeded',  $presence_data);
         echo $this->pusher->socket_auth($_POST['channel_name'], $_POST['socket_id'] ,   $d);
    }
    public function fetchPosts()
    {
    
        $userId = Application::$app->session->userId;
         $data = $this->request->getBody();
        $offset = $data['offset'];
        if($this->request->method() == "POST")
        {

             $this->jData['posts'] = $this->model->fetchPosts($userId , $offset);
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
        $postUserId = $data['postUserId'];
        $addnotfication = $data['addnotfication'];
        $comment = $data['comment'];
        $userName = $data['userName'];
        if($this->request->method() == "POST")
        {
             if($this->model->addComment($userId , $postId , $comment) )
             {

               $this->jData["comment"] = $this->model->fetchComments( $postId);
               if($addnotfication == "true")
               {
                   $pusherData['userId'] = $userId;
                   $pusherData["userName"] = user::displayName();
                   $pusherData["postUserId"] = $postUserId;
                   $pusherData["postId"] = $postId;
                   $to = [];
                   $allcommentsUsers = $data['allcommentsUsers'];
                   $to = explode(",",$allcommentsUsers);
                   $pusherData["to"] = $to;
                   $notificationModel = new notificationModel();
                   $notificationId = $notificationModel->addNotification($userId ,$to ,$postUserId , $postId ,$userName);
                   $pusherData["notificationId"] = $notificationId;
                   $this->pusher->trigger( $_ENV['CHANNEL'], 'addComment',  $pusherData);
               }

             }
      
             $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    public function updateNotification()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $notificationId = $data['notificationId'];
        $notificationModel = new notificationModel();
        if($this->request->method() == "POST")
        {
          if($notificationModel->updateNotification($notificationId , $userId))
          {
              $this->jData["update"] = "success";
          }
          $this->json();
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
    
    // delete comment
   public function deleteComment()
    {
        $data = $this->request->getBody();
        $id = $data['id'];
        if($this->request->method() == "POST")
        {

          if($this->model->deleteComment($id))
          {
              $this->jData["delete"] = "success";
              
          }
          $this->json();
        }

    }
    // delete comment
   public function updateComment()
    {
        $data = $this->request->getBody();
        $comment =  $data['comment'];
        $id = $data['id'];
        if($this->request->method() == "POST")
        {

          if($this->model->updateComment($id , $comment))
          {
              $this->jData["update"] = "success";
              
          }
          $this->json();
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
    
    public function postDelete()
    {
        $data = $this->request->getBody();
        $userId = Application::$app->session->userId;
        $postId = $data['postId'];
        $type   = $data['attachmentType'];
        $alreadyHasAttach = $data['alreadyHasAttach'];
        if($this->request->method() == "POST")
        {
          if($alreadyHasAttach == "true")
                {
                 // remove old attach
                //  $oldattach = $this->model->getOldAttach($postId);
                 $dir = POSTS_PATH.$type."/".$postId;
                 deleteDirectory($dir);
                }
          if($this->model->postDelete( $postId , $userId))
          {
              $this->jData["delete"] = "success";
              
          }
          $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
    public function postEdit()
    {

        if($this->request->method() == "POST")
        {
            $data = $this->request->getBody();
            $userId = Application::$app->session->userId;
            $postId = $data['postId'];
            $attachNeedUpdate = $data["attachNeedUpdate"];
            $rules = $this->model->rules();
            $type = $data['attachmentType'];
            $oldType = $data['oldAttachTyp'];
            $alreadyHasAttach = $data['alreadyHasAttach'];
            $attachment = null;
            $validRules = $this->validate->isValid( $this->model , $rules , $data);
            // no upload or no file selected
            
            if($attachNeedUpdate == "false" AND $alreadyHasAttach == "true")
            {
                $this->model->updatePost( $postId); 
                $this->jData['updatePostOnly'] = "your post is updated ";
                $updatedPosts = $this->model->getlastUpdatedPost($postId,$userId);
                $updatedPost = array_shift($updatedPosts);
                $updatedPostToSend = [
                       "id" => $updatedPost->id ,
                      "postText" =>   $updatedPost->postText , 
                     "postDateModified" =>   $updatedPost->postDateModified,
                    ];
                $this->jData['updatePostOnly'] = $updatedPostToSend;
                
            }
            elseif($attachNeedUpdate == "false" AND $alreadyHasAttach == "false" )
            {
                    if(!$validRules)
                    {
                         $this->jData['errors'] =  $this->validate->getErrors();   
                    }else
                    {
                        $this->model->updatePost( $postId); 
                        $this->jData['updatePostOnly'] = "your post is updated ";
                        $updatedPosts = $this->model->getlastUpdatedPost($postId,$userId);
                        $updatedPost = array_shift($updatedPosts);
                        $updatedPostToSend = [
                               "id" => $updatedPost->id ,
                              "postText" =>   $updatedPost->postText , 
                             "postDateModified" =>   $updatedPost->postDateModified,
                            ];
                        $this->jData['updatePostOnly'] = $updatedPostToSend; 
                    }
                 
            }elseif($attachNeedUpdate == "true" && isset($_FILES['attachment']))
            {
               // first move attach
                if(!$_FILES["attachment"]["error"] == 4)
                {
                    if($type == "image")
                    {
                       $upload = new uploadImage("attachment"); 
                    }elseif($type == "video")
                    {
                        $upload = new uploadVideo("attachment"); 
                    }
                    elseif($type == "document")
                    {
                        $upload = new uploadDocs("attachment"); 
                    }
                    else
                    {
                        $upload = new uploadImage("attachment");  
                    }
                    $noError =  $upload->noError();
                    if($noError)
                    {
                        $dir = POSTS_PATH.$type."/".$postId."/";
                        $upload->move( $dir);
                        $attachment = $upload->getFileSavedNameInDb();
                     }else
                     {
                        $imageerrors =  $upload->showErrors();
                        foreach($imageerrors as $key=>$value)
                        {
                            $this->validate->addCustomError("attachment_error_msg" , $value);
                        }
                        $this->jData['attachment_error'] =  $this->validate->getErrors(); 
                     }
                 }
                // first get last attach and remove it or make it as archive
                 $this->model->updatePostWithAttach($postId , $attachment ,$type ); 
                 $updatedPosts = $this->model->getlastUpdatedPost($postId,$userId);
                 $updatedPost = array_shift($updatedPosts);
                 $updatedPostToSend = [
                      "id" => $updatedPost->id ,
                      "postText" =>   $updatedPost->postText , 
                     "postDateModified" =>   $updatedPost->postDateModified,
                     "attachment"          =>  $updatedPost->attachment,
                     "attachmentType"     => $updatedPost->attachmentType
              ];
              $this->jData['updateAllPost'] = $updatedPostToSend;
            }elseif($attachNeedUpdate == "true" && !isset($_FILES['attachment']) && $validRules)
            {
                // remove old attach
                 $dir = POSTS_PATH.$oldType."/".$postId;
                  deleteDirectory($dir);
                // first get last attach and remove it or make it as archive
                 $this->model->updatePostWithAttach($postId , $attachment ,$type ); 
                 $updatedPosts = $this->model->getlastUpdatedPost($postId,$userId);
                 $updatedPost = array_shift($updatedPosts);
                 $updatedPostToSend = [
                      "id" => $updatedPost->id ,
                      "postText" =>   $updatedPost->postText , 
                     "postDateModified" =>   $updatedPost->postDateModified,
                     "attachment"          =>  $updatedPost->attachment,
                     "attachmentType"     => $updatedPost->attachmentType
              ];
              $this->jData['updateAllPost'] = $updatedPostToSend;
            }
            elseif(!$validRules && $attachment == null)
            {
                 $this->jData['errors'] =  $this->validate->getErrors(); 
            }
    
            $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    public function sharePosts()
    {
        $userId = Application::$app->session->userId;
        if($this->request->method() == "POST")
        {
            $data = $this->request->getBody();
            $rules = $this->model->rules();
            $attachmentType = $data['attachmentType'];
            $validRules = $this->validate->isValid( $this->model , $rules , $data);
            $hasAttach = false;
            $postId = null;

            //  file selected
            if(isset($_FILES['attachment']) && $attachmentType != "null")
            {
                if(!$_FILES["attachment"]["error"] == 4)
                {
                   $hasAttach = true;
                   if($attachmentType == "image")
                   {
                      $upload = new uploadImage("attachment"); 
                   }elseif($attachmentType == "video")
                   {
                        $upload = new uploadVideo("attachment"); 
                   
                  }elseif($attachmentType == "document")
                   {
                        $upload = new uploadDocs("attachment"); 
                   }else
                   {
                       $upload = new uploadImage("attachment");  
                   }
                   
                   $noError =  $upload->noError(); 
                }
            }

                
            // if nothing wtire or image
            if(!$validRules AND $attachmentType == "null" ){
                $this->jData['errors'] =  $this->validate->getErrors();
            }
            if($validRules AND $hasAttach == false)
            {
              $postId =   $this->model->savePost( $userId); 
                $this->jData['success'] = "your post is shared ";
            }elseif($hasAttach == true )
            {
                 if($noError)
                 {
                    $postId = $this->model->savePost( $userId);
                    $dir = POSTS_PATH.$attachmentType."/".$postId."/";
                    $upload->move( $dir);
                    $attachment = $upload->getFileSavedNameInDb();
                    $this->model->saveAttachment($postId ,$userId , $attachment  , $attachmentType);
                    $this->jData['success'] = "your post is shared ";
                 }else
                 {
                     $imageerrors =  $upload->showErrors();
                    foreach($imageerrors as $key=>$value)
                    {
                        $this->validate->addCustomError("attachment_error_msg" , $value);
                    }
                    $this->jData['attachment_error'] =  $this->validate->getErrors();
                 }

            }
            
           
           $lastPost = $this->model->fetchlastPost($postId,$userId);
            $this->jData['lastPost'] = $lastPost ;
             $Pusherdata["post"] = [
                  "fromId" =>   $userId,
                  "lastPost" => $lastPost 
                  ];
            $this->pusher->trigger( $_ENV['CHANNEL'], 'updatePost',  $Pusherdata);
            $this->json();
        }else
        {
                $this->response->renderView("home",$this->data );
        }

    }
    
}