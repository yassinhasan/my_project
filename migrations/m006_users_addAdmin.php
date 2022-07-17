<?php

use core\app\Application;

class m006_users_addAdmin 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE app_users ADD COLUMN isAdmin tinyint (255) DEFAULT 0
    ");
    $stmt->execute();
    }
}