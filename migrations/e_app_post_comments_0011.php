<?php

use core\app\Application;

class e_app_post_comments_0011 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_post_comments   
            ADD CONSTRAINT dk_app_users_comments
             FOREIGN  KEY (userId) REFERENCES  app_users(id) 
            ON DELETE CASCADE ON UPDATE CASCADE
             
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_post_comments"
        );
        $stmt->execute();
    }
}