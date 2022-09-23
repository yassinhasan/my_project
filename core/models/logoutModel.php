<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
class logoutModel extends abstractModel
{

    static public $tableName = "app_users";
    
    
    public function rules()
    {
    }

 
    
    public function updateLoginStatus($userId)
    {
        $this->data([
            "userStatus" => STATUS_OFLINE
            ])->where(" id = ? " , $userId)->update(self::$tableName);
        return true;
    }
}