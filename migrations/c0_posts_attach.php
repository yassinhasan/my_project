<?php
use core\app\Application;
class c0_posts_attach 
{

    
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS posts_attach
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            attachment VARCHAR(255) DEFAULT NULL ,
            postId INT(11) DEFAULT NULL ,
            attachmentType VARCHAR(255) DEFAULT NULL , 
            userId INT(11) DEFAULT NULL
        )");
        $stmt->execute();       
   }
   
   public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS posts_attach"
        );
        $stmt->execute();
    }

}