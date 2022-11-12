<?php

use core\app\Application;
use core\app\user;
$user = user::findUser();

?>
<!-- Navbar -->
  <!-- Container wrapper -->
  <div class="container-fluid">
      <div class="row row_wraper" style="width:100%;align-items: center;">
         <div class="col col-3">
              <a class="navbar-brand mt-2 mt-lg-0" href="/home"><?= PROJECT_NAME ?></a>         
         </div>
         <div class="col col-9 right_wraper">
             <div class="navbar_wraper row">
                <?php
                if(!$user): ?>
                <li class="nav-item nav-register ">
                <a class="nav-link nav-register" href="/register">register</a>
                </li>
                <li class="nav-item nav-register">
                <a class="nav-link" href="#">|</a>
            </li>
                <li class="nav-item nav-register">
                <a class="nav-link" href="/login">login</a>
            </li>
                <?php  endif ;?>
                <li class="noti_wraper nav-item dropdown">
                            <i class="fas fa-bell noti_icon dropdown-toggle" id="notiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <span class="noti_count" >0</span>
                            </i>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notiDropdown">
                                  <div class="notfication_box">
                                      <span class="no_notification_span"> no notification</span>
                                  </div>
                            </div>
                 </li>
                <li class="nav-item dropdown">
                      <?php
                    if($user): ?>
                        <a  class="nav-link dropdown-toggle logged_user_name" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-loggedUserId=<?= Application::$app->session->userId?>>
                            
                            <span class="username"><?= $user->firstName." ".$user->lastName?></span>
                          <img
                            src="<?= user::displayImage(); ?>"
                            class="rounded-circle user_profile_image"
                            height="22"
                            alt="Black and White Portrait of a Man"
                          />
                        </a>
                        
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile">profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/logout">logout</a></li>
                    </ul>
                    <?php endif;?>
            </li>
                  <!-- Avatar -->                 
             </div>

         </div>
      </div>
      <!-- Notifications -->
  </div>

<!-- Navbar -->
    
