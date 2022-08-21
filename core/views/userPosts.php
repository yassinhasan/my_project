<?php

use core\app\Application;
use core\app\user;
    $isMe = false;
    $loggedUserId = Application::$app->session->userId;
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
?>


<div class="container">
    <!--profile of user-->
        <div class="card profile_user">
             <h3 class="card-title" style="text-align: center;margin: 8px 0"><?= $user->firstName." ".$user->lastName?></h3>
            <div class="profile_user_image_box">
            <?php 
          
             $image = $user->image == null ? 'avatar.jpg' : $user->firstName.$user->lastName."/".$user->image;
            ?>
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
               <div class="card post_box" mt="20" style="margin: 20px 0 ">
                   <?php
                    if(count($user_posts) > 0)
                    {
                        for($i =count($user_posts); $i--;) {
                             $type = $user_posts[$i]->type;
                             $postId = $user_posts[$i]->id;
                             $image = $user_posts[$i]->image == null ? 'avatar.jpg' : $user_posts[$i]->firstName.$user_posts[$i]->lastName."/".$user_posts[$i]->image;
                    ?>
                    
                         <div class="post_box_details"  id="post_box_details_<?=$postId?>">
                              <div class="card-body big_card_body">
                                    <div class="card-body post_text_box">
                                        <p class="card-title post_text"><?=$user_posts[$i]->postText?></p>
                                        <span class="card-text post_date"><small class="text-muted"> <?=$user_posts[$i]->postDate?></small></span>
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
                                 <div class="comments_form_box hidden" id="comments_form_box_<?=$postId?>">
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

