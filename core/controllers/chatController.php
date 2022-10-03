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
    public function loadChat()
    {
       $this->jData["data"] = "helli";
       $this->json();
     //   $this->response->renderView("/chat", $this->data);
    }

    public function addMsg()
    {
        // $id = (int)$this->session->userId;
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
        }else
        {
            $this->jData['errors'] =  $this->validate->getErrors();
          
        }
        $this->json();
    }
}
