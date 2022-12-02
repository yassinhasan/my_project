<?php

use core\app\Application;

class g_app_notifications_000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_notifications (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    type VARCHAR (255) DEFAULT NULL , 
                    notificationDate DATETIME DEFAULT CURRENT_TIMESTAMP 
                     )

        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_notifications"
        );
        $stmt->execute();
    }
}