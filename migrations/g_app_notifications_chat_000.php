<?php

use core\app\Application;

class g_app_notifications_chat_000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_notifications_chat (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    notificationId INT (11) DEFAULT NULL , 
                    fromId INT (11) DEFAULT NULL , 
                    fromUsername VARCHAR (255) DEFAULT NULL , 
                    toId INT (11) DEFAULT NULL , 
                    ChatId INT (11) DEFAULT NULL , 
                    isSeen Text  DEFAULT NULL 
                     )

        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_notifications_chat"
        );
        $stmt->execute();
    }
}