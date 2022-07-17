<?php
namespace core\models;

use core\app\Application;
use core\app\Response;
use core\app\Validate;

abstract class abstractModel 
{
    protected $rules = [];
    public $pdo;
    abstract public function rules();
    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function __call($name, $arguments)
    {
    //    return  Application::$app->db->$name($arguments);
       return call_user_func_array([Application::$app->db , $name ], $arguments);
    }

    public function getById($primaryKey)
    {
        $sql = " SELECT * FROM ".get_called_class()::$tableName." WHERE ".get_called_class()::$primaryKey." = ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1 , $primaryKey);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;

    }

    public function getAll()
    {
        $results =  $this->from(get_called_class()::$tableName)->select()->fetchAll();
        return $results;
    }



}