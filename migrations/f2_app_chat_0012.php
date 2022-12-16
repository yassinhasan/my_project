<?php

use core\app\Application;

class f2_app_chat_0012 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_chat
            ADD CONSTRAINT dk_app_chat_unique2
             FOREIGN  KEY (ChatId) REFERENCES  app_chat_unique(id) 
            ON DELETE CASCADE ON UPDATE CASCADE
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