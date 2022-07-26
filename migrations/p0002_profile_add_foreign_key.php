<?php

use core\app\Application;

class p0002_profile_add_foreign_key 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE app_users_profile 
            ADD CONSTRAINT dk_app_users_profile
            FOREIGN  KEY (userId) REFERENCES  app_users(id)
        
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