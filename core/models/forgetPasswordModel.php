<?php
namespace core\models;

use PDO;
use core\app\user;
use core\app\Validate;

class forgetPasswordModel extends abstractModel 
{

    public $email ="";
    public static $tableName = "app_users";
    public  $user = null;
    public function rules()
    {
        return [
            "email" => [Validate::FIELD__REQUIRED , Validate::FIELD__EMAIL]
        ];
    }

    public function isValidEmail($email)
    {
      $stmt = $this->pdo->prepare("SELECT `email` , `firstName`  , `lastName` , `id` FROM ".self::$tableName." WHERE email =  ? " );
      $stmt->bindValue(1 , $email , PDO::PARAM_STR);
      if($stmt->execute())
      {
          $results= $stmt->fetchAll(PDO::FETCH_CLASS);
          $result = array_shift($results);
          $this->setUserLostPassword($result);
         return ($result !== null);
      }
    }


    public function setUserLostPassword($user)
    {
        $this->user = $user;
    }
    public function getUserLostPassword()
    {
      return  $this->user;
    }

    public function updateUserForgetPasswordCode($user , $code)
    {

        
        $this->data([
            "forgetPasswordCode" => $code
        ])->where('id = ? ' , $user->id)->update('app_users');
    }





}