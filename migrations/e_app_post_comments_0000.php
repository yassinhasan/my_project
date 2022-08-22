<?php
use core\app\Application;
class e_app_post_comments_0000 
{

    
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS app_post_comments
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            postId INT (11) ,
            userId INT (11) ,
            comment VARCHAR (255) , 
            commentDate DATETIME DEFAULT CURRENT_TIMESTAMP ,
            commentStatus VARCHAR (50) DEFAULT NULL ,
            hasReplies INT DEFAULT 0
        )");
        $stmt->execute();       
   }
   
   public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_post_comments"
        );
        $stmt->execute();
    }

}