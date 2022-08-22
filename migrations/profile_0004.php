<?php

use core\app\Application;

class profile_0004 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
        ALTER TABLE app_user_profile ADD COLUMN lastUpdated  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        
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