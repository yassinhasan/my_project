<?php namespace core\controllers;
use core\app\Application;
use core\models\chatModel;
use core\models\notificationModel;
class chatController extends abstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new chatModel();
        $this->data["model"] = $this->model;
        $this->data["title"] = "chat";
        $this->data["links"] = ["css" => ["chat"], "js" => ["chat"]];
    }

    public function addMsg()
    {
        // $id = (int)$this->session->userId;
        if($this->request->getMethod() == "POST")
        {
            $notificationId  = null;
            $data = $this->request->getBody();
            $model =  $this->model;
            $rules = $this->model->rules();
            $ChatId = $data["ChatId"] ;
            $f_time  = $data["f_time"];
            $openChat = $data["openChat"];
            if( $this->validate->isValid( $model ,$rules, $data))
            {
             
                $returnArray = $this->model->insertMsg($ChatId);
                $ChatId  = $returnArray[0];
                $msgId  = $returnArray[1];
                $this->jData['ChatId'] =  $ChatId;
                $this->jData['msgId'] =  $msgId; 
                $this->jData["f_time"] = $f_time;
                $this->jData['succ'] =  "done";   
                $this->jData['msgId'] = $msgId;

                if($openChat == false || $openChat == "false")
                {
                    $notificationModel = new notificationModel();
                    $notificationId = $notificationModel->addChatNotification($data["fromId"] ,$data["toId"] , $ChatId  ,  $data["firstName"]);
                    $pusherData["notificationId"] = $notificationId;
                }
                $Pusherdata["msgs"] = [
                    "fromId" => $data["fromId"] , 
                    "toId"   => $data["toId"] , 
                    "msg"   => $data["msg"] , 
                    "firstName" => $data["firstName"] , 
                    "ChatId" => $ChatId ,
                    "msgId"  =>$msgId , 
                    "notificationId" => $notificationId
                ];
                if($notificationId != null)
                {
                        // add pusher here tommorrow
                        $this->pusher->trigger( $_ENV['CHANNEL'], 'sendMessageNotification',  $Pusherdata);
                }
              $this->pusher->trigger( $_ENV['CHANNEL'], 'updateChate',  $Pusherdata);
            }else
            {
                $this->jData['errors'] =  $this->validate->getErrors();
              
            }
            $this->json();           
        }

    }
    
    public function fetchPrivateChat() 
    {
 // $id = (int)$this->session->userId;
        if($this->request->getMethod() == "POST")
        {
            $data = $this->request->getBody();
            $this->jData['msgs'] = $this->model->fetchPrivateChat($data);
             $Pusherdata["data"] = [
                 "userId" => Application::$app->session->userId ,
                 "chatId" =>  $data["ChatId"] , 
                 "toId" => $data["toId"] ,
                "openChat" => true
                 ];
          
            $this->pusher->trigger( $_ENV['CHANNEL'], 'isHereInChat',  $Pusherdata);
            $this->json();
        }

    }
    public function blurEvent() 
    {
      if($this->request->getMethod() == "POST")
        {
            $data = $this->request->getBody();
            $this->jData['msgs'] = $this->model->fetchPrivateChat($data);
             $Pusherdata["data"] = [
                 "userId" => Application::$app->session->userId ,
                 "chatId" =>  $data["ChatId"] , 
                 "toId" => $data["toId"] ,
                 "openChat" => false
                 ];
          
            $this->pusher->trigger( $_ENV['CHANNEL'], 'isHereInChat',  $Pusherdata);
            $this->json();
        }

    }
    // public function fetchChatUsers()
    // {
    //    $userId = Application::$app->session->userId;
    //     if($this->request->getMethod() == "POST")
    //     {
    //         $data = $this->request->getBody();
    //         $this->jData['users'] = $this->model->fetchChatUsers($userId);
    //         $this->jData["loggedUserId"] = $userId;
    //         $this->json();
            
    //     }

    // }
   
    public function blur()
    {
         $id = (int)$this->session->userId;
        if($this->request->getMethod() == "POST")
        {

              $Pusherdata["userId"] = $id;
              $Pusherdata["onlineStatus"] = STATUS_ONLINE;
              $this->pusher->trigger( $_ENV['CHANNEL'], 'isLogged',  $Pusherdata);
        }

    }
    
    
    
}
