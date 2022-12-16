<?php

use core\app\Application;

class f00_app_chat_unique_0000
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_chat_unique (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY ,
                    msgDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                     )
                    
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_chat_unique"
        );
        $stmt->execute();
    }
}