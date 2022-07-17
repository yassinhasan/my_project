<?php 
namespace core\controllers;

use core\app\encryptDecrypt;
use core\models\resetPasswordModel;

class resetPasswordController extends abstractController 
{
    use encryptDecrypt;
    public function __construct()
    {
        
        parent::__construct();
        $this->model = new resetPasswordModel();
        $this->data["title"] = "reset password";
        $this->data['model'] = $this->model;
        $this->user = null;
        $this->data['links'] = [
          //   "css" => ["resetpassword"] ,
            "js" => ["resetpassword"]
        ];
    } 

    public function resetPassword()
    {
       if($this->request->method() == 'GET')
       {
            $code = $this->request->get("code");
            
            $user = $this->model->getUserByCode($code);
            if($user != null)
            {
              
            $this->response->renderView("resetpassword" , $this->data);
            }else
            {  
            $this->customExceptions->load(404 ,  ["message" =>"Sorry This Link Is Expired "]);
            }
       }else
       {
        
            $data = $this->request->getBody();
            $code = $data["code"];
            $user = $this->model->getUserByCode($code);
            if($user == null)
            {
                $this->jData['inValidCode'] = "Sorry This Link May Be Expired";
            }else
            {
                
                if($this->validate->isValid($this->model , $this->model->rules() ,$data))
                {
                
                  
                  $password =  password_hash($data['password'] , PASSWORD_DEFAULT);
                   
                   if( $this->model->updatePassword($user ,$password))
                   {

                    $this->session->setFlashMsg("success_resetpassword" , " Your Password Has Updated");
                    $this->jData["success"]  = " Your Password Has Updated You Will Redirected To Login Page Now";
                   }else
                   {
                    $this->jData["update_error"]  = " Your Password Has Updated You Will Redirected To Login Page Now"; 
                   }
                    
                }else
                {
                   
                    $this->jData["errors"] = $this->validate->getErrors();
            
                }
                $this->json();
            }
        }

    }


       /// if request is post 
       /*
        if post {
            get data from post
            make validation vy valiation class
            pass rules found in updatepassword model
            then if pass 
            update two things in app_users
            first password to new password
            second update forgetcode to null 
            then send success message password has benn updated
            then redirect to login page
            
        }*/
}

