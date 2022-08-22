<?php

use core\app\Application;

class profile_0005 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
        ALTER TABLE `app_user_profile` CHANGE `mobile` `mobile` INT UNSIGNED ZEROFILL NULL DEFAULT NULL;        
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