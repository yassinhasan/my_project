<?php

use core\app\Application;

class f2_app_chat_attach_0011 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_chat_attach   
            ADD CONSTRAINT dk_app_chat_attach
             FOREIGN  KEY (msgId) REFERENCES  app_chat(id) 
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