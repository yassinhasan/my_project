<?php

use core\app\Application;
class likes_0011 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE app_post_likes
            ADD CONSTRAINT fk_app_posts_likes
            FOREIGN  KEY (postId) REFERENCES app_posts(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
         $stmt->execute();
    }
}