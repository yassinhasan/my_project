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
                  <div class="card-header bg bg-info text-light">
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
            <div class="card-body users_box_details">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="../../public/uploades/images/profile/smsmhasan/avatar.jpg"  class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                              <div class="card-header users_box_name">
                                smsm hasan
                              </div>
                              <div class="users_box_follow">
                                  <button class="btn  follow_btn " type="submit" name="follow">
                                      follow
                                  </button>
                                   <span class="card-text follower_num">0 <span class="follower_text">Followers </span></span>
                              </div>
                        </div>
                   </div>
                </div>
            </div>
        <!-- end start users info details -->

    </div>
     <!-- end main users info -->
</div>

