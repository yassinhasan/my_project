<?php

use core\app\Application;

class p0004_profile_add_lastUpdated_on_update 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
        ALTER TABLE app_users_profile ADD COLUMN lastUpdated  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        
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