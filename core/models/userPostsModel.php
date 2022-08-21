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
            INNER JOIN app_users_profile  ON 
            app_users_profile.userId = app_users.id
            ")->where("app_users.id = ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.email ,app_users.lastName , app_users_profile.*  ,
            ( select status from app_follow where sender = $loggedUserId and receiver = $userId ) as follow_status  ,
              ( select COUNT(app_follow.receiver) from app_follow where receiver = app_users.id AND status = 'approve') as followers   
            ")->fetch();
    }
    
        public function fetchPostsById($userId ,  $loggedUserId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.userId
           
            INNER JOIN app_users_profile  ON 
             app_users_profile.userId = app_posts.userId
            ")
            ->where(" app_posts.userId = ? " , $userId)
            ->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_users_profile.image  ,
             (SELECT  COUNT(app_users_comments.postId) from app_users_comments where app_users_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where (app_posts_likes.type = 'like' AND app_posts_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where ( app_posts_likes.type = 'unlike' AND app_posts_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_posts_likes.type from app_posts_likes where ( app_posts_likes.userId =  $loggedUserId AND app_posts_likes.postId = app_posts.id ) )as type
             ")->fetchAll();

        return $posts;
 
    }
}