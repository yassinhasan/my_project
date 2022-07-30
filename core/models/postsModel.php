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
            'post'=>[ Validate::FIELD__REQUIRED , Validate::FIELD__STRING]

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
        $posts = $this->from(self::$tableName)->where("app_posts.userId = ? " , $userId)->join(" INNER JOIN app_users ON 
            app_users.id = app_posts.userId")->select("
             *")->fetchAll();
        return $posts;
        

    }
}