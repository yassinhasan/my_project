<?php
namespace core\controllers;

use core\app\Application;
use core\app\cookie;
use core\app\encryptDecrypt;
use core\models\loginModel;

class loginController extends abstractController
{
    use encryptDecrypt;
    public function __construct()
    {
        
        parent::__construct();
        $this->model = new loginModel;
        $this->data["title"] = "login";
        $this->data['model'] = $this->model;
        $this->data['links'] = [
            "css" => ["login"] ,
            "js" => ["login" ]
        ];
    }


    // check if post then check data else if view this page 
    public function login()
    {
        $isLogged = authenticateController::isLogged();
        if($isLogged)
        {
            $this->response->redirect("/");
        }
        // if request method is get so show page else if show respnse from form 
        if($this->request->method() == "POST")
        {
            $rules = $this->model->rules() ;
            $data = $this->request->getBody();
            if ( $this->validate->isValid( $this->model , $rules , $data) )
            {
              
                $user = $this->model->findUser();
                if ($user) 
                {
                    $rememberMe = isset($data["rememberMe"]) ?? null ;
                    $password =  $data['password'];
                    $hashedUsername = $this->encrypt($user->firstName.$user->lastName);
                    if(password_verify($password , $user->password ))
                    {
                        if($rememberMe and $rememberMe =="yes")
                        {
                            
                            $this->cookie->setCookie("loginCode" ,  $hashedUsername);
                        }else
                        {
                              $this->session->loginCode =  $hashedUsername;                        
                        }
                        $this->session->userId = $user->id;
                        if($user->isAdmin == 1)
                        {
                            $this->jData['success_admin'] = "you have login succuflly";
                        }else
                        {
                          $this->jData['success'] = "you have login succuflly";  
                        }
                         $this->session->setFlashMsg("success_login" , " you have login succuflly");
                        
                    }else
                    {
                        $this->validate->addCustomError("password" , "sorry this Password is not matched");
                        $this->jData['errors'] =  $this->validate->getErrors();
                      
                    }
                }else
                {
                    $this->validate->addCustomError("email" , "sorry this Email does not exists");
                    $this->jData['errors'] =  $this->validate->getErrors();
                }
               
                
                
            }else
            {
                $this->jData['errors'] =  $this->validate->getErrors();
                
             
            }
        
            $this->json();
           
        }else
        {
            $this->response->renderView("login" ,$this->data );
        }
    


    }

    // check valid data vs rules for this model 






}