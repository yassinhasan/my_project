<?php

use core\app\Application;

class profile_0011 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_user_profile   
            ADD CONSTRAINT dk_app_users_profile     
             FOREIGN  KEY (userId) REFERENCES  app_users(id) 
             ON DELETE CASCADE ON UPDATE CASCADE;
        
        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_profile"
        );
        $stmt->execute();
    }
}