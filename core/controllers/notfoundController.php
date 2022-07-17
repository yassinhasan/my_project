<?php
namespace core\controllers;

use core\app\Application;
class notfoundController extends abstractController
{


    public $data = [
        "title" => "notfound"
    ];
    public function notfound()
    {
       
        $this->response->renderView("notfound" , $this->data);
    }
}