<?php

use core\app\Application;
class posts_0001 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE app_posts  CHANGE users userId INT(11) 
        ");
         $stmt->execute();
    }
}