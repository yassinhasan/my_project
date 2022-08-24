<?php

use core\app\Application;
use core\app\user;

?>


<div class="container">
    <!-- main page consist of posts and usersinfo-->
    <div class="main_page row" data-singlePage="false">
        <!--posts-->
        <div class="col col-8 main_page_posts_box">
            <!--share posts-->
           <div class="card">
                  <div class="card-header share_post_header">
                    Share Your Post
                  </div>
                  <div class="card-body shar_post_box">
                      <form class="share_post_form" action="/sharePosts" enctype="multipart/form-data">
                        <div class="mb-3" style="margin-bottom: 5px">
                            <div name="post" class="form-control textarea_text" id="Write_Post" contentEditable="true">
                                <p class="post_text"></p>
                                <img class="post_image" hidden/>
                            </div>
                        </div>
                        <div class="share_post_attach row ">
                             <div class="add_attach col-1">
                             <i class="fa-solid fa-photo-film"></i>
                            </div>
                            <div class="add_audio col-1">
                                <i class="fa-solid fa-volume-high"></i>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" name="sharePost" value="Share" class="btn btn-primary share_post_btn">
                            Share
                            </button>
                        </div>                          
                      </form>

                  </div>
                </div>
                
                <!-- posts-->
               <div class="card post_box" mt="20" style="margin: 20px 0 "></div>
                <!--end posts-->
        </div>
        <!-- users info -->
        <div class="col col-4 users_box">
                <!-- start users info details-->
               <!-- end start users info details -->

        </div>
     <!-- end main users info -->
    </div>
</div>

