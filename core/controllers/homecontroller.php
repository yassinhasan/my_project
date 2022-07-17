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
                // "vendor/jquery/jquery.min" ,
                // "vendor/bootstrap/js/bootstrap.bundle.min"
                // ,"vendor/jquery-easing/jquery.easing.min"
                // ,"admin/sb-admin-2.min",
                // "vendor/chart.js/Chart.min"
                // ,"admin/demo/chart-area-demo"
                // ,"admin/demo/chart-pie-demo"
            ]
        ];
        $this->response->renderView("/home" ,$data , ["nav" , "bodyStart" , "bodyEnd"] );
    }
}