<?php

use core\app\Application;
class likes_0012 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE app_post_likes
            ADD CONSTRAINT fk_app_posts_users_likes
            FOREIGN  KEY (userId) REFERENCES app_users(id)
        ");
         $stmt->execute();
    }
}