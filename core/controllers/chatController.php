<?php namespace core\controllers;
use core\app\Application;
use core\models\chatModel;
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
            $data = $this->request->getBody();
            $model =  $this->model;
            $rules = $this->model->rules();
            if( $this->validate->isValid( $model ,$rules, $data))
            {
                $msgId  = $this->model->insertMsg();
                if($this->model->addAttachMsg($msgId))
                {  
                    $this->jData['succ'] =  "done";  
                }else
                {
                    $this->jData['errors'] =  "error in db";
                }
              $Pusherdata["msgs"] = [
                  "fromId" => $data["fromId"] , 
                  "toId"   => $data["toId"] , 
                  "msg"   => $data["msg"] , 
                  "firstName" => $data["firstName"]
                  ];
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
            $this->json();
        }

    }
    public function fetchChatUsers()
    {
       $userId = Application::$app->session->userId;
        if($this->request->getMethod() == "POST")
        {
            $data = $this->request->getBody();
            $this->jData['users'] = $this->model->fetchChatUsers($userId);
            $this->json();
        }

    }
    
}
