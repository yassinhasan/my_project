<div class="container">
<?php

    $this->view->startPostForm($model , "/register");
    echo '<div class="row"> '   ;
    $this->view->renderInput( ["firstName" => "First Name" ,
                                 "lastName"   => "Last Name"] , "text" , "col-6");
    echo "</div>";
    $this->view->renderInput( ["email" => "Type Your Email" ]
                                , "email" );
    $this->view->renderInput( ["password" => "Type Your Password"  , 
                              "confirmPassword" => "Confirm Your Password"]
                                , "password");
    $this->view->renderSubmitBtn(["name" => "save" , 
    "class" => "primary register_btn" ,
    "label" => "submit"]);
    $this->view->endForm();
?>
</div>