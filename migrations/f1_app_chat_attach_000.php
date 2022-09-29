<?php

use core\app\Application;

class f1_app_chat_attach_000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_chat_attach (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    msgId INT (11) DEFAULT NULL , 
                    attachment Text  DEFAULT NULL ,
                    attachmentType  varchar(60) DEFAULT NULL 
                     )

        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS users"
        );
        $stmt->execute();
    }
}