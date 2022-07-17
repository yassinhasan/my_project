<?php

use core\app\Application;

class m0002_password 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE app_users ADD COLUMN password VARCHAR (255) DEFAULT NULL
    ");
    $stmt->execute();
    }
}