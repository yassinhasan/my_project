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
             app_posts.*  , app_users.firstName , app_users.lastName , app_users_profile.image ")->fetchAll();

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
}