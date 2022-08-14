<?php

use core\app\Application;
use core\app\user;

?>


<div class="container">
    <!-- main page consist of posts and usersinfo-->
    <div class="main_page row">
        <!--posts-->
        <div class="col col-8">
            <!--share posts-->
           <div class="card">
                  <div class="card-header share_post_">
                    Share Your Post
                  </div>
                  <div class="card-body shar_post_box">
                      <form class="share_post_form" action="/sharePosts">
                        <div class="mb-3">
                            <label for="Write_Post" class="form-label">Write your Post</label>
                            <textarea name="post" placeholder="Write your Post" 
                            class="form-control textarea_text" id="Write_Post" maxLength="200" rows="3"></textarea>
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
           <div class="card post_box" mt="20" style="margin: 20px 0 ">
          </div>
                <!--end posts-->
        </div>
        <!-- users info -->
        <div class="col col-4 users_box">
                <!-- start users info details-->
               <!-- end start users info details -->

        </div>
     <!-- end main users info -->
</div>

