<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;

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
            'firstName'=>[ Validate::FIELD__REQUIRED , Validate::FIELD__STRING],
            'lastName' => [Validate::FIELD__REQUIRED , Validate::FIELD__STRING],
             'email'=> [
                        Validate::FIELD__REQUIRED , Validate::FIELD__EMAIL  ,
                        [Validate::FIELD__UNIQUE =>[self::$tableName, "email"] ]
                        ] , 
             'password'=> [Validate::FIELD__REQUIRED , [Validate::FIELD__MIN => 4 ] , [Validate::FIELD__MAX => 12 ]],
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
        ])->insert(self::$tableName);
        return true;
    }
}