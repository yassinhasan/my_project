<?php
namespace core\models;

use PDO;
use core\app\user;
use core\app\Validate;

class resetPasswordModel extends abstractModel 
{

    public $password ="";
    public $confirmPassword ="";
    public static $tableName = "app_users";
    public  $user = null;
    public function rules()
    {
        return [
            'password'=> [Validate::FIELD__REQUIRED , [Validate::FIELD__MIN => 4 ] , [Validate::FIELD__MAX => 12 ]],
            'confirmPassword'=> [Validate::FIELD__REQUIRED , [Validate::FIELD__MATCHED => "password"]]

        ];
    }

    public function getUserByCode($code)
    {
       
        $user =$this->from("app_users")->where(" forgetPasswordCode = ? " , "$code")->select(" * ")->fetch();
        return $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function updatePassword($user , $password)
    {
     
      $count =  $this->data([
        'password' => $password , 
        'forgetPasswordCode'=> null
        ])->where("id = ?" , $user->id)->update($this::$tableName);
       return $count > 0 ;
    }
  


}