<?php

use core\app\Application;

class h_app_notifications_comments_000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_notifications_comments (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    notificationId INT (11) DEFAULT NULL , 
                    fromId INT (11) DEFAULT NULL , 
                    fromUsername VARCHAR (255) DEFAULT NULL , 
                    toId INT (11) DEFAULT NULL , 
                    postId INT (11) DEFAULT NULL , 
                    isSeen Text  DEFAULT NULL 
                     )

        ");
        $stmt->execute();
    }
    public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_notifications_comments"
        );
        $stmt->execute();
    }
}