<?php

use core\app\Application;
use core\app\user;
    $isMe = false;
    $loggedUserId = Application::$app->session->userId;
    $founduser = null;
    $userStatus = $user->userStatus == 1 ? "online" : "offline";
    if(isset($user))
    {
      $userId = $user->id;
      if($loggedUserId == $userId) $isMe = true;
      $follow="";
      $follow_class="";
      if ($user->follow_status == null || $user->follow_status == 'NULL' || $user->follow_status == 'null'){
      $follow = 'follow' ; 
      $follow_class = "follow";
      }
      else if ($user->follow_status == 'pending') {
        $follow = "pending";
        $follow_class = "follow";
      }
      else {
        $follow = "unfollow";
        $follow_class = "unfollow";
        }
      $userName = $user->firstName." ".$user->lastName;
      $image = $user->profileImage == null ? 'avatar.jpg' : $user->firstName.$user->lastName."/".$user->profileImage;
    }else
    {
      echo "<h3>sorry this user not found</h3>";
      return;
    }

?>


<div class="container" >
    <!--profile of user-->
        <div class="card profile_user">
            <div class="user_status_div">
              <h3 class="card-title" style="text-align: center;margin: 8px 0"><?= $userName?></h3>
              <div class="online_status_icon_div">
                    <i class="fas fa-circle online_status" data-userId="<?=$user->id?>" data-status="<?=$userStatus?>"></i>

              </div>
            </div>
              <div class="profile_user_image_box">
              <img src="../../public/uploades/images/profile/<?=$image?>" class="card-img-top profile_user_image_box_img" alt="...">
         </div>
          <div class="card-body profile_user_info">
            <p class="card-text">Bio : <?= $user->bio ?></p>
            <p class="card-text">Gender : <?= $user->gender ?></p>
            <p class="card-text">Mobile : <?= $user->mobile ?></p>
            <p class="card-text">Email : <?= $user->email ?></p>
            <p class="card-text">created At : <?= (explode(" ",$user->createdAt))[0] ?></p>
            <!--follow-->
            
            <div class="users_box_follow" data-id="<?=$user->id?>" data-status="<?=$user->follow_status ?>">
                <?php 
                if(!$isMe)
                { ?>
                  <button class="btn  follow_btn <?=$follow_class ?>" type="submit" name="follow"><?= $follow ?>
                  </button>                   
                    
               <?php }
                
                ?>

                 <div class="card-text"><span class="follower_num"><?= $user->followers ?></span> <span class="follower_text">Followers </span></div>
                 </div>
            <!-- unfollow-->
          </div>
        </div>
    <!--end profile of user -->
    <!-- main page consist of posts and usersinfo-->
    <div class="main_page" data-singlePage="true">
        <!--posts-->
        <div class="main_page_posts_box">
                <!-- posts-->
               <div class="card post_box"  style="margin: 20px 0 ">
                   <?php
                    
                    $edit = "";
                    if($user_posts and count($user_posts) > 0)
                    {
                        for($i =count($user_posts); $i--;) {
                             $type = $user_posts[$i]->likeType;
                             $postId = $user_posts[$i]->id;
                             $image = $user_posts[$i]->profileImage == null ? 'avatar.jpg' : $user_posts[$i]->firstName.$user_posts[$i]->lastName."/".$user_posts[$i]->profileImage;
                            //  attachment
                            $attachment = $user_posts[$i]->attachment == null ? null  : $user_posts[$i]->attachment;
                            $post = readMore($user_posts[$i]->postText , $postId);
                            $post_date =  $user_posts[$i]->postDate ;
                            $attachment_div= "";
                            $attachment_type = $user_posts[$i]->attachmentType;
                             if($attachment_type == "image"){
                                   $attachment_div = "<div class='post_attachment_div' data-type='image'>
                                   <div class='img_container'>
                                   <img src='../../public/uploades/images/posts/image/$postId/$attachment' loading='lazy' class='post_attachment image_attach' alt=''/>
                                   </div>
                                   <div class='card-title post_text'>$post</div>
                                   <span class='card-text post_date'><small class='text-muted post_date_release'>$post_date</small></span>
                                   </div>";
                             }else if($attachment_type == "video")
                              {
                               $src = explode(".",$attachment);
                               $filename =  $src[0];
                               $filetype  = $src[1];
                        
                               $attachment_div = "<div class='post_attachment_div' data-type='video'>
                                                <video  controls  class='video_attach' >
                                                  <source src='../../public/uploades/images/posts/video/$postId/$attachment'  type='video/mp4' >
                                                  Your browser does not support the video tag.
                                                </video>
                                                <div class='card-title post_text'>$post</div>
                                                <span class='card-text post_date'><small class='text-muted post_date_release'>$post_date</small></span>
                                           </div>";
                        
                            }else if($attachment_type == "document")
                            {
                          
                                $shorted_attachemnt = handle_file_name($attachment);
                                
                                $attachment_div = "
                                <div class='post_attachment_div' data-type='document'>
                                <div class='card-title post_text'>$post</div>
                                <span class='card-text post_date'><small class='text-muted post_date_release'>$post_date</small></span>
                                <div class='file_thumb_div'>
                                        <i class='fas fa-file file_thumb'></i>
                                        <span class='filename'><a download href='../../public/uploades/images/posts/document/$postId/$attachment'>$shorted_attachemnt</a></span>
                                    </div>
                                  </div>
                                    ";
                            }else
                            {
                              $attachment_div = "
                              <div class='post_attachment_div' data-type='null'>
                              <div class='card-title post_text'>$post</div>
                              <span class='card-text post_date'><small class='text-muted post_date_release'>$post_date</small></span>
                                </div>
                                  ";
                            }
                            
                            //end attachment
                            if($isMe)
                            {
                                $edit =  "<div class='edit_box_edit' data-postId='$postId' data-bs-toggle='modal' data-bs-target='#postEditModal'>edit</div>
                                      <div class='edit_box_delete' data-postId='$postId'>delete</div>";
                            };
                    ?>
                    
                         <div class="post_box_details"  id="post_box_details_<?=$postId?>">
                              <div class="card-body big_card_body">
                                    <div class="card-body post_text_box">
                                        <?=   $attachment_div ?>
                                    </div>
                                
                               </div>
                                <!-- here comments -->
                               
                               <div class="card-body comments_box"> 
                                    <div class="comments" data-postId=<?=$postId?> id="comments_<?=$postId?>">
                                        <div class="comments-stats">
                                             <span class="comments_num"><?=$user_posts[$i]->comments?></span>
                                             <span> comments</span>
                                        </div>
                               </div>
                                <!-- here form of comments -->
                                 <div class="comments_form_box hidden" id="comments_form_box_<?=$postId?>" data-postId="<?= $postId ?>">
                                 </div>
                                <!-- end form of comments -->
                                <!-- end here comments -->
                            </div>
                            
                            <!-- likes -->
                                    <div class="likes_box">
                                        <div data-postId="<?=$postId?>" id="likes_box_<?=$postId?>">
                                            <div class="is_like">
                                                 <span class="likes_num no_of_likes"><?=$user_posts[$i]->liked ?></span>
                                                 <i class="fas fa-thumbs-up like_btn  <?= $type == 'like' ? 'active' : ''?>" data-type="like"></i>
                                            </div>
                                             <div class="i_dislike">
                                                 <span class="dislikes_num no_of_likes"><?= $user_posts[$i]->disliked ?> </span>                                 
                                                 <i class="fas fa-thumbs-down dislike_btn 
                                                 <?= $type == 'unlike' ? 'active' : '' ?> "    data-type="unlike"></i> 
                                             </div>
                                        </div>

                                </div>
                            <!-- end likes -->
                            <!--edit-->
                            <div class="edit_big_box col-1 showt_edit_div" data-show="<?=$i?>">
                                       <i class="fas fa-ellipsis-v"></i>
                                       <div class="edit_box" id="edit_box_<?=$i?>">
                                          <div class="edit_box_showPost" data-postid="<?=$postId?>"><a href="/showPost?postId=<?=$postId?>">Show Post</a>
                                          </div>
                                          <?= $edit ?>
                                     </div>
                            </div>
                            <!--end edit-->
                        </div> 
                        
                        <?php    }
                        }
                    
                    else
                    {
                     echo " No Posts "; 
                    }
                   ?>
               </div>
                <!--end posts-->
        </div>
    </div>
</div>

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