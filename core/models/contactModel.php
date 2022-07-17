<?php
namespace core\models;

use core\app\Rrequest;

class contactModel extends abstractModel
{
    public $firstname;
    public $lastname;
    public $email;
    static public $tableName = "app_contact";
    static public $primaryKey = "id";
    public function rules()
    {
        return $this->rules = [
            'firstname'=>[ self::FIELD__REQUIRED],
            'lastname' => [self::FIELD__REQUIRED],
            'email'=> [self::FIELD__REQUIRED , self::FIELD__EMAIL  , [self::FIELD__UNIQUE => [self::$tableName, "email"]] , ]

        ];

    }


    // public function delete($id)
    // {
        
    //    echo $this->where( " id =  ?  " , [$id])->delete(static::$tableName)->rowCount();
       
    // }



    // public function getUser()
    // {
    //     return $this->from(static::$tableName)->where( " id = ?   " , 1 )->select( " firstName , lastName ")->fetchAll();
    // }

    public function getBy()
    {
        $stmt = $this->byQuery( " select ac.firstName , au.email from app_contact ac 
            inner join app_users au 
            on ac.id = au.id 
        ");
        $results = $stmt->fetchAll(\PDO::FETCH_CLASS);
        pre($results);
    }




}