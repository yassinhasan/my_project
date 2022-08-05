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
            ")->where("app_posts.userId = ? " , $userId)->select("
             app_posts.*  , app_users.firstName , app_users.lastName , app_users_profile.image ")->fetchAll();

        return $posts;
        

    }
    public function fetchUsers($userId)
    {
        $posts = $this->from(" app_users " )->join(" 
            INNER JOIN app_follow  ON 
            app_users.id = app_posts.userId
            INNER JOIN app_users_profile  ON 
            app_users_profile.userId = app_posts.userId
            ")->where("app_posts.userId = ? " , $userId)->select("
             app_posts.*  , app_users.firstName , app_users.lastName , app_users_profile.image ")->fetchAll();

        return $posts;
        

    }
}