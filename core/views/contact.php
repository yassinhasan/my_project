<?php

    $this->view->startPostForm($model);
    echo '<div class="row"> '   ;
    $this->view->renderInput(["firstname" => "First Name" ,
                                 "lastname"   => "Last Name"] , "text" , "col-6");
    echo "</div>";
    $this->view->renderInput(["email" => "Type Your Email" ]
                                , "email" );

    $this->view->renderSubmitBtn();
    $this->view->endForm();
?>
