<?php
namespace core\controllers;

use core\app\Application;
use core\app\cookie;
use core\app\encryptDecrypt;
use core\lib\sendMessageClass;
use core\lib\showMessagesFromPostRequest;
use core\models\forgetPasswordModel;
use core\models\loginModel;
use core\models\resetPasswordModel;

class forgetPasswordController extends abstractController
{
    use encryptDecrypt;
    use showMessagesFromPostRequest;
    public function __construct()
    {
        
        parent::__construct();
        $this->model = new forgetPasswordModel;
        $this->data["title"] = "forget password";
        $this->data['model'] = $this->model;
        $this->data['links'] = [
            "css" => ["foregtpassword"] ,
            "js" => ["foregtpassword" ]
        ];
    }


        // forget password
        public  function forgetPassword()
        {
            // if post request
            if($this->request->getMethod() == "POST")
            {
     

                $email= $this->request->getBody()['email'];
                
                // if this is valid email  
                if($this->validate->isValid($this->model , $this->model->rules() , $this->request->getBody()))
                {
                    // if this email is found id db in tables app_users
                    if( $this->model->isValidEmail($email))
                    {
                        $user = $this->model->getUserLostPassword();
                        $userName = $user->firstName." ".$user->lastName;
                        $passwordRecoveryCode = password_hash($userName , PASSWORD_DEFAULT);
                        $forgetUrl =  $this->request->baseUrl()."resetPassword?code=$passwordRecoveryCode";

                        $emailMessage = new sendMessageClass();
                        $emailMessage->prepareMessage([
                            'to' => $email ,
                            'to_name' => $userName , 
                            'subject' => 'reset password '  ,
                            'body'  => "<h5> hello <span style='color:red ; fontSize: 22px;'> $userName </span> </h5>
                            <p>
                            you have request to reset password 
                            if you already request this please click in this link below
                            
                            </p>
                            <a href='$forgetUrl'>click here </a>
                            " , 
                            'alt_body' => 'empty'
                        ]);
                        $this->model->updateUserForgetPasswordCode($user ,$passwordRecoveryCode);
                        if($emailMessage->send())
                        {
                            
                            $this->jData['success'] = "Message has been sent";
                        }
                       else
                        {
                          //  $this->validate->addCustomError("email" , "Sorry This Is Problem In Sending Email Now");
                            $this->jData['errors'] =  $this->validate->getFirstError("email"); 
                        }

                    }else
                    {
                        $this->validate->addCustomError("email" , "Sorry This email Is not Found");
                        $this->jData['errors'] =  $this->validate->getFirstError("email");
                        
                    }
                  
                 
                }else
                {
                    $this->jData['errors'] =  $this->validate->getFirstError("email");
                }
                $this->json();
            
            }else
            {
                $this->response->renderView("forgetpassword" , $this->data );
            }
            
        }

        /*
            scenario 
            by click on reset password 

            fetch url //forgetPassword/resetPassword by post
            then send email to this url 
            and if email is already sent 
            sent suc msg email is already sent and  check your email
            then 
            get email from input
            /////

            when email is sent 
            insert into user where email is found this code

            send code to link 
            //forgetPassword/resetPassword?code=-----------
           then whenn code come from email
           select user where code = code if found delete this code
           then show reset password page 
           enter new password 
           change password into db according to this email
            
        */








}