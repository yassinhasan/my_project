<?php namespace core\models;
use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
class showPostModel extends abstractModel
{
    public function rules()
    {
        return [];
    }
    
    public function fetchPostsById($postId ,$loggedUserId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.postUserId
            INNER JOIN app_user_profile  ON 
             app_user_profile.userId = app_posts.postUserId
             LEFT JOIN posts_attach  ON 
            posts_attach.postId = app_posts.id 
            ")
            ->where(" app_posts.id = ? " , $postId)
            ->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_user_profile.profileImage  ,
             posts_attach.attachment , posts_attach.attachmentType  ,
             (SELECT  COUNT(app_post_comments.postId) from app_post_comments where app_post_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where (app_post_likes.likeType = 'like' AND app_post_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where ( app_post_likes.likeType = 'unlike' AND app_post_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_post_likes.likeType from app_post_likes where ( app_post_likes.userId =  $loggedUserId AND app_post_likes.postId = app_posts.id ) )as likeType
             ")->fetchAll();

        return $posts;
 
    }
}
