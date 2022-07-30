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
                  <div class="card-body">
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
           <div class="card" mt="20" style="margin-top: 20px">
                  <div class="card-header bg bg-info text-light">
                    my name is
                  </div>
                  <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= User::displayImage();?>" class="img-fluid rounded-start  post_user_image" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                          </div>
                        </div>
                   </div>
                </div>
          </div>
                <!--end posts-->
        </div>
        <!-- users info -->
        <div class="col col-4">
            iam users
        </div>
    </div>
</div>

