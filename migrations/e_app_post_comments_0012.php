<?php

use core\app\Application;

class e_app_post_comments_0012 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_post_comments   
            ADD CONSTRAINT dk_app_posts_comments
              FOREIGN  KEY (postId) REFERENCES app_posts(id)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
        $stmt->execute();
    }

}