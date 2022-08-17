<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;

class postsModel extends abstractModel
{
    public $postText;
    static public $tableName = "app_posts";
    public function rules()
    {
        return  [
            'post'=>[ Validate::FIELD__REQUIRED]

        ];

    }
        //create users
    public function savePost($userId)
    {
        $this->data([
            "postText" => $this->post ,
            "userId"   => $userId
        ])->insert(self::$tableName);
        return true;
    }
    public function fetchPosts($userId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.userId
            INNER JOIN app_users_profile  ON 
            app_users_profile.userId = app_posts.userId
            
            ")->where(" app_posts.userId = ?  or app_posts.userId = ( select app_follow.receiver from app_follow
            where app_follow.sender = $userId and app_follow.receiver = app_users.id and status = 'approve'
            )" 
            
            , $userId)->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_users_profile.image  ,
             (SELECT  COUNT(app_users_comments.postId) from app_users_comments where app_users_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where (app_posts_likes.type = 'like' AND app_posts_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where ( app_posts_likes.type = 'unlike' AND app_posts_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_posts_likes.type from app_posts_likes where ( app_posts_likes.userId = $userId AND app_posts_likes.postId = app_posts.id ) )as type
             ")->fetchAll();

        return $posts;
        

    }
    public function fetchUsers($userId)
    {
        $posts = $this->from(" app_users " )->join(" 
            INNER JOIN app_users_profile  ON 
            app_users_profile.userId = app_users.id
            ")->where("app_users.id != ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.lastName , app_users_profile.image  ,
            ( select status from app_follow where sender = $userId and receiver = app_users.id ) as status  ,
              ( select COUNT(app_follow.receiver) from app_follow where receiver = app_users.id AND status = 'approve') as followers   
            ")->fetchAll();

        return $posts;
        

    }
   public function fetchUpdateUserFollowSystem($userId ,  $followerId , $status)
    {

        $alreadyFollowered = 
        $this->from(" app_follow " )->where(" sender = ? AND receiver = ? " , [$userId , $followerId])->select(" * ")->fetchAll();
        if($alreadyFollowered == null)
        {
           $this->data([
            "sender" => $userId ,
            "receiver" => $followerId ,
            "status" => $status , 
            ])->insert(" app_follow "); 
        }else
        {
         $this->data([
        "status" => $status , 
        
        ])->where(" sender = ? AND receiver = ? " , [$userId , $followerId])->update(" app_follow ");
        }
        
        return true;
    }
    
    public function addComment($userId , $postId , $comment)
    {
        if ($this->data([
            "postId" => $postId , 
            "userId"  => $userId , 
            "comment" => $comment , 
            
            ])->insert("app_users_comments"))
            {
                return true;
            }

    }
        
    public function fetchComments( $postId )
    {
              return  $this->from("app_users_comments")->join("
                
                INNER JOIN app_users_profile on 
                app_users_profile.userId = app_users_comments.userId
                INNER JOIN app_users on
                app_users.id  = app_users_comments.userId
                 INNER JOIN app_posts on
                app_posts.id  = app_users_comments.postId
                ")->where("app_posts.id = ? " , $postId)->select(" app_users_comments.* , app_users_profile.image ,app_users.firstName ,app_users.lastName , 
                 (SELECT  COUNT(app_users_comments.postId) from app_users_comments where app_users_comments.postId = $postId) as comments
                ")->fetchAll();
    }
    
    // likes
    
    // select from likes if user make like if true
    //  if user->type of like = type so return already liked 
    //  if not equal to type make update where user and post 
    // so every user has only on like or not like
    public function addLike($userId , $postId ,$type)
    {
        
        
        $alreadyLiked = 
        $this->from(" app_posts_likes " )->where(" postId = ? AND userId = ?  " , [ $postId , $userId ])->select(" * ")->fetch();
        if($alreadyLiked == null)
        {
        
            $this->data([
            "postId" => $postId , 
            "userId"  => $userId , 
            "type" => $type , 
            
            ])->insert("app_posts_likes"); 
        }else if($alreadyLiked->type =="like" AND $type == "unlike")
        {
          
         $this->data([
        "type" => "unlike" , 
        ])->where("  postId = ?  AND userId = ? " , [$postId , $userId])->update(" app_posts_likes ");
        }else if($alreadyLiked->type =="unlike" AND $type == "like")
        {
         $this->data([
        "type" => "like" , 
        ])->where("  postId = ?  AND userId = ? " , [$postId , $userId])->update(" app_posts_likes ");
        }
        
        return true;

    }
        
        // select count likes and dislikes where post id 
    public function fetchLikes( $postId )
    {
              return  $this->from("app_posts_likes")->where("app_posts_likes.postId = ? " , $postId)->select(" 
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where (app_posts_likes.type = 'like' AND app_posts_likes.postId = $postId) )as liked , 
             (SELECT  COUNT(app_posts_likes.id) from app_posts_likes where ( app_posts_likes.type = 'unlike' AND app_posts_likes.postId = $postId) ) as disliked
                ")->fetch();
    }
}