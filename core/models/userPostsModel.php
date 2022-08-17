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
    
    public function getuserPostsInfo($userId)
    {
        return $this->from("app_users")->where("id = ? " , $userId)->select(" * ")->fetchAll();
    }
}