
<div class="container">
<?php

use core\app\Application;

   $this->view->getFlashMsg("success" , "success");
   $this->view->getFlashMsg("success_resetpassword" , "success");
?>

<form method="POST" action="/login" class="form">
      <div class="mb-3 ">
          <label for="email" class="form-label">Type Your Email </label>
          <input type="email" class="form-control " id="email" name="email" value="">
     </div>
     <div class="mb-3 ">
         <label for="password" class="form-label">Type Your Password </label>
         <input type="password" class="form-control " id="password" name="password" value="">
     </div>
     <div class="form-check">
            <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="rememberMe" value="yes">
            <label class="form-check-label" for="flexCheckDefault">
            rememberMe
            </label>
    </div>
    <a href="/forgetPassword" style="margin:10px 0;display:inline-block"> Forget Password
    </a> | 
    <a href="/register" style="margin:10px 0;display:inline-block"> Register
    </a>
    <br>
    <button type="submit" class="btn btn-primary login_btn" name="save">login
    </button>
</form>


</div>
<div class="background_overlay">
</div>