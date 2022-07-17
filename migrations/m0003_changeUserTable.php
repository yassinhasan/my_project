<?php

use core\app\Application;

class m0003_changeUserTable 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE users RENAME TO app_users
    ");
    $stmt->execute();
    }
}