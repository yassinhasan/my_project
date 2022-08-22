<?php

use core\app\Application;

class profile_0003 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
        ALTER TABLE app_user_profile ADD COLUMN createdAt  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        
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