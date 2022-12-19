<?php

use core\app\Application;

class a1_users_0000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
        ALTER TABLE app_users ADD COLUMN lastActivity  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_users"
        );
        $stmt->execute();
    }
}