<?php
use core\app\Application;
class b0_posts_0000 
{

    
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS app_posts
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            postText VARCHAR(255) ,
            postDate DATETIME DEFAULT CURRENT_TIMESTAMP ,
            postDateModified DATETIME DEFAULT NULL,
            comments VARCHAR(255) DEFAULT NULL,
            postUserId int (11) DEFAULT NULL ,
            postViews INT(11) DEFAULT 0 ,
            postImages VARCHAR(255) DEFAULT NULL 
        )");
        $stmt->execute();       
   }
   
   public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_posts"
        );
        $stmt->execute();
    }

}