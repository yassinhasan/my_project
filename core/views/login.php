<div class="container">
<?php

use core\app\Application;

   $this->view->getFlashMsg("success" , "success");
   $this->view->getFlashMsg("success_resetpassword" , "success");
    $this->view->startPostForm($model , "/login");
    $this->view->renderInput( ["email" => "Type Your Email" ]
                                , "email" );
    $this->view->renderInput( ["password" => "Type Your Password"]
                                , "password");
    $this->view->renderCheckBtn("rememberMe" , "yes" , "rememberMe");
?>
    <a href="/forgetPassword" style="margin:10px 0;display:inline-block"> Forget Password </a> | <a href="/register" style="margin:10px 0;display:inline-block"> Register </a>
    <br>
<?php    $this->view->renderSubmitBtn(["name" => "save" , 
                                "class" => "primary login_btn" ,
                                "data" => "data_target='/login'" ,
                                "label" => "login"]);
    $this->view->endForm();
?>
</div>