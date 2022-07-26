<?php

use core\app\Application;

class m0003_users_forgetpassword
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE app_users ADD COLUMN forgetPasswordCode VARCHAR (255) DEFAULT NULL
    ");
    $stmt->execute();
    }
}