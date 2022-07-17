<div class="container">
<div class="reset_password row justify-center" style="margin-top: 100px" >

<?php

    $this->view->startPostForm($model , "/resetPassword");
    echo "<div class='row'>";
    $this->view->renderInput( ["password" => "Type Your New Password" ]
                                , "password" , "col-12");
    $this->view->renderInput( ["confirmPassword" => "Retype Your New Password" ]
                                , "confirm Password" , "col-12");
  //  $this->view->getFlashMsg('success');      
    echo "</div>";                      
    $this->view->renderSubmitBtn(["name" => "send" , 
                                "class" => "primary reset_password_btn" ,
                                "data" => "data_target='/resetPassword'" ,
                                "label" => "Save"]);
    $this->view->endForm();
?>
</div>
</div>