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
           <div class="share_post_box">
               <div class="card">
                      <div class="card-header share_post_header">
                        Share Your Post
                      </div>
                      <div class="card-body shar_post_box">
                          <form class="share_post_form" action="/sharePosts" enctype="multipart/form-data">
                               <div class="post_edit_image"> </div>
                            <div class="mb-3" style="margin-bottom: 5px">
                                <div class="textarea_text_box">
                                    <textarea  name="post" class="form-control textarea_text" id="Write_Post" placeholder="write your day"></textarea>
                                    <img class="post_image" hidden src=".." alt=""/>
                                </div>
                            </div>
                            <div class="share_post_attach row ">
                                 <div class="add_attach col-1">
                                 <i class="fa-solid fa-photo-film"></i>
                                </div>
                                <div class="add_docs col-1">
                                    <i class="fas fa-file" aria-hidden="true"></i>
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
                <div class="progress_div">
                    <span class="progress"></span>
                </div>               
           </div>

                
                <!-- posts-->
               <div class="card post_box" style="margin: 20px 0 "></div>
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


<!--model -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="postEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="postEditModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary share_post_btn">Save Changes</button>
      </div>
    </div>
  </div>
</div>
<!--end modal -->

<div class="floadting_btn" data-bs-toggle="modal" data-bs-target="#postChatModal">
        <i class="far fa-comment-alt"></i>
</div>

<!-- Modal -->
<div class="modal fade" id="postChatModal"   tabindex="-1" aria-labelledby="postChatModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <!--start dialaog-->
  <div class="modal-dialog chat-dialaog-modal">
   <!--user area -->
    <div class="modal-content user_section">
      <!--start header-->
      <div class="modal-header">
        <div class="card-header card_userchat_header  bg-info">
                    <!--<i class="fas fa-angle-left"></i>-->
          <p class="mb-0 fw-bold">Live chat</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <!--end header-->
      <!--start body-->
      <div class="modal-body user_chat_body">
         <div class="fetch_users_div">
           
         </div>
      </div>
      <!--end body-->
    </div>
   <!--end user area -->
  <!--start  chat area --> 
    <div class="modal-content chat_section hide">
      <!--start header-->
      <div class="modal-header">
        <div class="card-header card_chat_header   bg-info">
                    <!--<i class="fas fa-angle-left"></i>-->
          <p class="mb-0 fw-bold">Live chat</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>
      <!--end header-->
      <!--start body-->
      <div class="modal-body">
       here i will fetch chat
      </div>
      <!--end body-->
    </div>
  <!--end  chat area -->    
  </div>
    <!--end dialaog-->
</div>
<!--end modal -->