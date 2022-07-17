<?php
namespace core\models;

use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
class profileModel extends abstractModel
{

    public $email ="";
    public $password = "";
    static public $tableName = "app_users_profile";
    public function rules($id = null)
    {
        return  [
                 'email'=> [
                            Validate::FIELD__REQUIRED , Validate::FIELD__EMAIL  ,
                            [Validate::FIELD__UNIQUE_IN_OHER =>["app_users", "email" , "id" , $id] ]
                            ] , 
                 'mobile'=> [ Validate::FIELD__INT ,[Validate::FIELD__EQUAL => 10 ]],
                'bio'=> [[Validate::FIELD__MAX => 150]]
                 ]
        ;

    }

    //create users
    public function findUser()
    {
       
       $findUser =  $this->from(self::$tableName)->where( " email  = ? " , $this->email)->select( " * ")->fetch();
       return $findUser;
    }

    public function updateProfileInfo($id ,$data)
    {
        try {
            // first update email and this must be required
            $this->data([
                "email" => $data['email']
            ])->table("app_users")->where(" id =  ? " , $id)->update();
            
            $hasProfile = $this->from(self::$tableName)->where
            ("userId = ? " , $id)->select()->fetch();
            // if has profile no need to enter userId
            $mobile = $data['mobile'] == "" ? null : $data['mobile'];
            if($hasProfile)
            {
                
                $this->data([
                    "mobile" => $mobile ,
                    "gender" => $data['gender'] ,
                    "bio" => $data['bio'] ,
                ])->table(self::$tableName)->where(" userId =  ? " , $id)->update();
            }else
            {
                $this->data([
                    "mobile" => $mobile  ,
                    "gender" => $data['gender'] ,
                    "bio" => $data['bio'] ,
                    "userId" => $id
                    
                ])->table(self::$tableName)->insert();
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
       
    }
    public function updateProfileImage($id ,$data)
    {
        try {            
            $hasProfile = $this->from(self::$tableName)->where
            ("userId = ? " , $id)->select()->fetch();
            if($hasProfile)
            {
                $this->data([
                    "image" => $data ,
                ])->table(self::$tableName)->where(" userId =  ? " , $id)->update();
            }else
            {
                $this->data([
                    "image" =>$data ,
                    "userId" => $id
                    
                ])->table(self::$tableName)->insert();
            }
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
       
    }

}