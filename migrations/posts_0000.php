<?php
use core\app\Application;
class posts_0000 
{

    
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS app_posts
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            users INT (11) ,
            postText VARCHAR(255) ,
            postDate DATETIME DEFAULT CURRENT_TIMESTAMP ,
            postDateModified DATETIME DEFAULT NULL,
            comments VARCHAR(255) DEFAULT NULL,
            views INT(11) DEFAULT 0 ,
            images VARCHAR(255) DEFAULT NULL 
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