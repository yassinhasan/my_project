<?php

use core\app\Application;

class p0001_profile 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_users_profile (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    gender ENUM('male','female')  ,
                    mobile  INT(11) DEFAULT NULL ,
                    image VARCHAR(255) DEFAULT NULL ,
                    bio VARCHAR(255) DEFAULT NULL ,
                    userId INT (11)    
                    )
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_profile"
        );
        $stmt->execute();
    }
}