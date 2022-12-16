<?php

use core\app\Application;

class f0_app_chat_0000 
{
    public function up()
    {

        $stmt = Application::$app->db->pdo->prepare( "
                CREATE TABLE IF NOT EXISTS app_chat (
                    id INT (11) AUTO_INCREMENT PRIMARY KEY  , 
                    chatId INT (11) DEFAULT NULL ,
                    fromId INT (11) DEFAULT NULL , 
                    toId INT (11) DEFAULT NULL ,
                    msg  Text DEFAULT NULL ,
                    msgDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP   ,
                    hasAttach tinyint (2) DEFAULT 0 ,
                    hasReplies tinyint (2) DEFAULT 0  ,
                    isSeen tinyint (2) DEFAULT 0   ,
                     hasLikes tinyint (2) DEFAULT 0
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