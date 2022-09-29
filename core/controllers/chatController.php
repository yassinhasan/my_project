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
}
