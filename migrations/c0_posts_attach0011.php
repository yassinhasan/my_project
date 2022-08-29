<?php

use core\app\Application;
class c0_posts_attach0011 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare("

            ALTER TABLE posts_attach
            ADD CONSTRAINT fk_posts_attach
            FOREIGN  KEY (postId) REFERENCES app_posts(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
         $stmt->execute();
    }
}