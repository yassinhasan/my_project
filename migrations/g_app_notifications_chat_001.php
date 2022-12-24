<?php

use core\app\Application;

class g_app_notifications_chat_001 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
             ALTER TABLE app_notifications_chat 
            ADD CONSTRAINT dk_app_notification_id_chat
             FOREIGN  KEY (notificationId) REFERENCES  app_notifications(id) 
            ON DELETE CASCADE ON UPDATE CASCADE
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