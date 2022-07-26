<?php
namespace core\controllers;

use core\app\Application;

class homecontroller extends abstractController
{


    public function home()
    {

        $data = [
            "title" => "home"
        ];
        $data['links'] = [
            "css" => ["home"] ,
            "js" => [
                "home" ,

            ]
        ];
        $this->response->renderView("/home" ,$data );
    }
}