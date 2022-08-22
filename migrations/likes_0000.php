<?php
use core\app\Application;
class likes_0000 
{
 
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS app_post_likes
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            postId INT (11) ,
            userId INT (11) ,
            likeType varchar (50) default 0
        )");
        $stmt->execute();       
   }
   
   public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_post_likes"
        );
        $stmt->execute();
    }

}