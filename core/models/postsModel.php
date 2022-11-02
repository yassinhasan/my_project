<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;
use core\app\Application;
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
        if($this->data([
            "postText" => $this->post ,
            "postUserId"   => $userId 
        ])->insert(self::$tableName));
  
        return Application::$app->db::lastId();
    }
    
    public function saveAttachment($postId , $userId , $attachment = null , $attachmentType =null)
    {
        $this->data([
            "postId" =>  $postId ,
            "attachment"   => $attachment , 
            "attachmentType"   => $attachmentType ,
            "userId"       => $userId
        ])->insert("posts_attach");
        return true;
    }
    public function fetchPosts($userId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.postUserId
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_posts.postUserId 
            LEFT JOIN posts_attach  ON 
            posts_attach.postId = app_posts.id 
            ")->where(" app_posts.postUserId = ?  or app_posts.postUserId = ( select app_users_follow.receiver from app_users_follow
            where app_users_follow.sender = $userId and app_users_follow.receiver = app_users.id and followStatus = 'approve'
            )" 
            
            , $userId)->order( " ORDER BY  postDate DESC ")->limit( " LIMIT 2 ")->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_users.userStatus , app_user_profile.profileImage  ,
             posts_attach.attachment , posts_attach.attachmentType  ,
             (SELECT  COUNT(app_post_comments.postId) from app_post_comments where app_post_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where (app_post_likes.likeType = 'like' AND app_post_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where ( app_post_likes.likeType = 'unlike' AND app_post_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_post_likes.likeType from app_post_likes where ( app_post_likes.userId = $userId AND app_post_likes.postId = app_posts.id ) )as likeType
             ")->fetchAll();

        return $posts;
 
    }
    public function fetchlastPost($postId,$userId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            INNER JOIN app_users  ON 
            app_users.id = app_posts.postUserId
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_posts.postUserId 
            LEFT JOIN posts_attach  ON 
            posts_attach.postId = app_posts.id 
            ")->where(" app_posts.id = ?  " , $postId)->select("
             app_posts.*  ,app_users.id as userId , app_users.firstName , app_users.lastName , app_user_profile.profileImage  , app_users.userStatus ,
             posts_attach.attachment , posts_attach.attachmentType  ,
             (SELECT  COUNT(app_post_comments.postId) from app_post_comments where app_post_comments.postId = app_posts.id) as comments ,
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where (app_post_likes.likeType = 'like' AND app_post_likes.postId = app_posts.id )) as liked , 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where ( app_post_likes.likeType = 'unlike' AND app_post_likes.postId = app_posts.id ) )as disliked ,
             (SELECT app_post_likes.likeType from app_post_likes where ( app_post_likes.userId = $userId AND app_post_likes.postId = app_posts.id ) )as likeType
             ")->fetchAll();

        return $posts;
 
    }
    public function fetchUsers($userId)
    {
        $Users = $this->from(" app_users " )->join(" 
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_users.id
            ")->where("app_users.id != ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.lastName , app_users.userStatus , app_user_profile.profileImage  ,
            ( select followStatus from app_users_follow where sender = $userId and receiver = app_users.id ) as followStatus  ,
              ( select COUNT(app_users_follow.receiver) from app_users_follow where receiver = app_users.id AND followStatus = 'approve') as followers   
            ")->fetchAll();

        return $Users;
        

    }
   public function fetchUpdateUserFollowSystem($userId ,  $followerId , $status)
    {

        $alreadyFollowered = 
        $this->from(" app_users_follow " )->where(" sender = ? AND receiver = ? " , [$userId , $followerId])->select(" * ")->fetchAll();
        if($alreadyFollowered == null)
        {
           $this->data([
            "sender" => $userId ,
            "receiver" => $followerId ,
            "followStatus" => $status , 
            ])->insert(" app_users_follow "); 
        }else
        {
         $this->data([
        "followStatus" => $status , 
        
        ])->where(" sender = ? AND receiver = ? " , [$userId , $followerId])->update(" app_users_follow ");
        }
        
        return true;
    }
    
    public function addComment($userId , $postId , $comment)
    {
        if ($this->data([
            "postId" => $postId , 
            "userId"  => $userId , 
            "comment" => $comment , 
            
            ])->insert("app_post_comments"))
            {
                return true;
            }

    }
        
    public function fetchComments( $postId )
    {
              return  $this->from("app_post_comments")->join("
                
                INNER JOIN app_user_profile on 
                app_user_profile.userId = app_post_comments.userId
                INNER JOIN app_users on
                app_users.id  = app_post_comments.userId
                 INNER JOIN app_posts on
                app_posts.id  = app_post_comments.postId
                ")->where("app_posts.id = ? " , $postId)->select(" app_post_comments.* , app_user_profile.profileImage ,app_users.firstName ,app_users.lastName , 
                 (SELECT  COUNT(app_post_comments.postId) from app_post_comments where app_post_comments.postId = $postId) as comments
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
        $this->from(" app_post_likes " )->where(" postId = ? AND userId = ?  " , [ $postId , $userId ])->select(" * ")->fetch();
        if($alreadyLiked == null)
        {
            $this->data([
            "postId" => $postId , 
            "userId"  => $userId , 
            "likeType" => $type , 
            
            ])->insert("app_post_likes"); 
        }else if($alreadyLiked->likeType =="like" AND $type == "unlike")
        {
          
         $this->data([
        "likeType" => "unlike" , 
        ])->where("  postId = ?  AND userId = ? " , [$postId , $userId])->update(" app_post_likes ");
        }else if($alreadyLiked->likeType =="unlike" AND $type == "like")
        {
         $this->data([
        "likeType" => "like" , 
        ])->where("  postId = ?  AND userId = ? " , [$postId , $userId])->update(" app_post_likes ");
        }
        
        return true;

    }
        
        // select count likes and dislikes where post id 
    public function fetchLikes( $postId )
    {
              return  $this->from("app_post_likes")->where("app_post_likes.postId = ? " , $postId)->select(" 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where (app_post_likes.likeType = 'like' AND app_post_likes.postId = $postId) )as liked , 
             (SELECT  COUNT(app_post_likes.id) from app_post_likes where ( app_post_likes.likeType = 'unlike' AND app_post_likes.postId = $postId) ) as disliked
                ")->fetch();
    }
    
    
    //  delete post by id
    
   public function postDelete($postId , $userId)
    {
        $count =  $this->from(" app_posts " )
         ->where("app_posts.id = ? And app_posts.postUserId = ? " , [$postId , $userId ])
         ->delete();

        return $count > 0;
        

    }
    
    public function updatePost($postId)
    {
        if($this->data([
            "postText" => $this->post ,
            "postDateModified" => date( 'Y-m-d H:i:s', time() )
        ])->where(" id = ? " , $postId)->update(self::$tableName))
        {
            return true;
        }
    }
        
    public function updatePostWithAttach($postId ,$attachment , $type)
    {
       if($this->data([
            "postText" => $this->post ,
            "postDateModified" => date( 'Y-m-d H:i:s', time() )
        ])->where(" id = ? " , $postId)->update(self::$tableName))
        {
            $this->data([
            "attachment" => $attachment ,
            "attachmentType" => $type
        ])->where(" postId = ? " , $postId)->update("posts_attach");
        }
        return true;
    }
    
    public function getlastUpdatedPost($postId)
    {
        $posts = $this->from(" app_posts " )->join(" 
            LEFT JOIN posts_attach  ON 
            posts_attach.postId = app_posts.id 
            ")->where(" app_posts.id = ?  " , $postId)->select("
           app_posts.id ,   app_posts.postText   , app_posts.postDateModified ,
             posts_attach.attachment , posts_attach.attachmentType  ")->fetchAll();

        return $posts;
 
    }
    public function getOldAttach($postId)
    {
        $getOldAttach = $this->from(" posts_attach " )
        ->where(" posts_attach.postId = ?  " , $postId)->select("
          attachment ,attachmentType  ")->fetch();
        return $getOldAttach;
 
    } 
}