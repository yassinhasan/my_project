<?php

use core\app\Application;

class m0001_users 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_users (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    firstName VARCHAR(255) DEFAULT NULL ,
                    lastName  VARCHAR(255) DEFAULT NULL ,
                    email VARCHAR(255) DEFAULT NULL )
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS users"
        );
        $stmt->execute();
    }
}