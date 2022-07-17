<?php
namespace core\controllers\admin;

use core\app\Application;
use core\controllers\abstractController;

class dashBoardController extends abstractController
{


    public function dashboard()
    {

        $data = [
            "title" => "dashboard" 
        ];
        $data['links'] = [
            "css" => ["admin/sb-admin-2.min"] ,
            "js" => [
                "vendor/jquery/jquery.min" ,
                "vendor/bootstrap/js/bootstrap.bundle.min"
                ,"vendor/jquery-easing/jquery.easing.min"
                ,"admin/sb-admin-2.min",
                "vendor/chart.js/Chart.min"
                ,"admin/demo/chart-area-demo"
                ,"admin/demo/chart-pie-demo"
            ]
        ];
        $this->response->renderView("admin/dashboard" ,$data , ["nav" , "bodyStart" , "bodyEnd"] );
    }
}