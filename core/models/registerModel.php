<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;
use core\app\Application;

class registerModel extends abstractModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $confirmPassword;
    static public $tableName = "app_users";
    public function rules()
    {
        return  [
            'firstName'=>[ Validate::FIELD__REQUIRED , Validate::FIELD__NAME],
            'lastName' => [Validate::FIELD__REQUIRED , Validate::FIELD__NAME],
             'email'=> [
                        Validate::FIELD__REQUIRED , Validate::FIELD__EMAIL  ,
                        [Validate::FIELD__UNIQUE =>[self::$tableName, "email"] ]
                        ] , 
             'password'=> [Validate::FIELD__REQUIRED , Validate::FIELD__PASSWORD , [Validate::FIELD__MIN => 4 ] , [Validate::FIELD__MAX => 12 ]],
            'confirmPassword'=> [Validate::FIELD__REQUIRED , [Validate::FIELD__MATCHED => "password"]]

        ];

    }

    //create users
    public function saveUser()
    {
        $this->data([
            "firstName" => $this->firstName ,
            "lastName" => $this->lastName ,
            "email" => $this->email ,
            "password" =>  password_hash($this->password , PASSWORD_DEFAULT),
        ])->insert(self::$tableName) ;
        $userId =  Application::$app->db::lastId() ;
        $this->data([
                    "userId" =>$userId 
            ])->table("app_user_profile")->insert(); 
        return true;
    }
}