<?php

use core\app\Application;

class M0005_more_coulmns_users 
{
    public function up()
    {
        $stmt = Application::$app->db->pdo->prepare( "
            ALTER TABLE app_users ADD status INT(2) DEFAULT 0 ,
                              ADD    verified INT(2) DEFAULT 0 ,
                              ADD    loginCode VARCHAR(255) DEFAULT NULL
    ;");
    $stmt->execute();
    }
}