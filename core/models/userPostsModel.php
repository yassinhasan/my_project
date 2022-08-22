<?php namespace core\models;
use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
class userPostsModel extends abstractModel
{
    public function rules()
    {
        return [];
    }
    
    public function getuserPostsInfo($userId , $loggedUserId)
    {
        return $this->from(" app_users " )->join(" 
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_users.id
            ")->where("app_users.id = ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.email ,app_users.lastName , app_user_profile.*  ,
            ( select followStatus from app_users_follow where sender = $loggedUserId and receiver = $userId ) as follow_status  ,
              ( select COUNT(app_users_follow.receiver) from app_users_follow where receiver = app_users.id AND followStatus = 'approve') as followers   
            ")->fetch();
    }
    
        public function fetchPostsById($userId ,  $loggedUserId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.postUserId
           
            INNER JOIN app_user_profile  ON 
             app_user_profile.userId = app_posts.postUserId
            ")
            ->where(" app_posts.postUserId = ? " , $userId)
            ->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_user_profile.profileImage  ,
             (SELECT  COUNT(app_post_comments.postId) from app_post_comments where app_post_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where (app_post_likes.likeType = 'like' AND app_post_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where ( app_post_likes.likeType = 'unlike' AND app_post_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_post_likes.likeType from app_post_likes where ( app_post_likes.userId =  $loggedUserId AND app_post_likes.postId = app_posts.id ) )as likeType
             ")->fetchAll();

        return $posts;
 
    }
}