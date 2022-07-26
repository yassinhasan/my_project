<?php
namespace core\controllers;

use core\app\Application;
use core\lib\sendMessageClass;
use core\models\registerModel;

class registerController extends abstractController
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new registerModel;
        $this->data["title"] = "register";
        $this->data['model'] = $this->model;
        $this->data['links'] = [
            "css" => ["register"] ,
            "js"  => ["register"]
        ];
    }


    // check if post then check data else if view this page 
    public function register()
    {
        //
        $isLogged = authenticateController::isLogged();
        if($isLogged)
        {
            $this->response->redirect("/");
        }
        // if request method is get so show page else if show respnse from form 
        if($this->request->method() == "POST")
        {
            $data = $this->request->getBody();
            $rules = $this->model->rules();
            if ($this->validate->isValid( $this->model , $rules , $data) )
            {
                if ($this->model->saveUser()) 
                {

                    /// test

                    $email= $this->request->getBody()['email'];
                    $userName = $this->request->getBody()['firstName'].$this->request->getBody()['lastName'];
                    $emailMessage = new sendMessageClass();
                    $emailMessage->prepareMessage([
                        'to' => $email ,
                        'to_name' => $userName , 
                        'subject' => PROJECT_NAME  ,
                        'body'  => "<h5> hello <span style='color:red ; fontSize: 22px;'> $userName </span> </h5>
                        <p>
                        you have registerd succusfully 
                        </p>
                        " , 
                        'alt_body' => 'empty'
                    ]);
                    if(!$emailMessage->send())
                    {
                        
                        $this->jData['message_error'] = "Message has not been sent";
                    }

                    /// end test
                    $this->session->setFlashMsg("success" , " your registration done");
                    $this->jData['success'] = "your registration done";
                }else
                {
                    $this->jData['sql_error'] = "sorry there is somthing error please try in another time";
                }
            }else
            {
                $this->jData['errors'] =  $this->validate->getErrors();
            }
            $this->json();
        }else
        {
                $this->response->renderView("register" ,$this->data );
        }
    


    }

    // check valid data vs rules for this model 



}