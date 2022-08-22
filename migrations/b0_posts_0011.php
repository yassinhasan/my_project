<?php

use core\app\Application;
class b0_posts_0011 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE app_posts
            ADD CONSTRAINT fk_app_posts_users
            FOREIGN  KEY (postUserId) REFERENCES app_users(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
         $stmt->execute();
    }
}