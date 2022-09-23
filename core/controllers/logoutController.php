<?php
namespace core\controllers;

use core\app\Application;
use core\app\cookie;
use core\app\encryptDecrypt;
use core\models\loginModel;
use core\models\logoutModel;
class logoutController extends abstractController
{
    use encryptDecrypt;
    public function __construct()
    {
         $this->model = new logoutModel;
        parent::__construct();
        $this->data['model'] = $this->model;
    }

    public function logout()
    {

        if($this->request->method() == "GET")
        {
         
            if(($this->session->userId))
            {
                $this->model->updateLoginStatus($this->session->userId);
                 $Pusherdata["userId"] = $user->id;
                 $Pusherdata["onlineStatus"] = "offline after logout";
                 $this->pusher->trigger( $_ENV['CHANNEL'], 'isLogged',  $Pusherdata);
                 $this->cookie->kill("loginCode");
                 $this->session->kill();
            }

            $this->response->redirect("/login");
        }
    


    }



}