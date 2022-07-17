<?php
namespace core\controllers;

use core\app\Application;
use core\app\cookie;
use core\app\encryptDecrypt;
use core\models\loginModel;

class logoutController extends abstractController
{
    use encryptDecrypt;
    public function __construct()
    {
        
        parent::__construct();
        $this->data['model'] = $this->model;
    }

    public function logout()
    {

        if($this->request->method() == "GET")
        {
         
            if(($this->session->userId))
            {
                $this->cookie->kill("loginCode");
                $this->session->kill();
            }
            $this->response->redirect("/login");
        }
    


    }



}