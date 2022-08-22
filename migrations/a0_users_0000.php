<?php

use core\app\Application;

class a0_users_0000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_users (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    firstName VARCHAR(255) DEFAULT NULL ,
                    lastName  VARCHAR(255) DEFAULT NULL ,
                    email VARCHAR(255) DEFAULT NULL   ,
                    forgetPasswordCode VARCHAR (255) DEFAULT NULL ,
                    password VARCHAR (255) DEFAULT NULL ,
                    userStatus INT(2) DEFAULT 0 ,
                     verified INT(2) DEFAULT 0 ,
                     loginCode VARCHAR(255) DEFAULT NULL , 
                     isAdmin tinyint (255) DEFAULT 0
                     )
                    
        
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