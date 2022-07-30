<?php

use core\app\Application;
class posts_0002 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE app_posts
            ADD CONSTRAINT fk_app_posts_users
            FOREIGN  KEY (userId) REFERENCES app_users(id)
        ");
         $stmt->execute();
    }
}