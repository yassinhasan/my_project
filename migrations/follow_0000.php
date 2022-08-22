<?php
use core\app\Application;
class follow_0000 
{

    
   public function up()
   {
    $stmt = Application::$app->db->pdo->prepare( "
        CREATE TABLE IF NOT EXISTS app_users_follow
        (
            id INT (11) AUTO_INCREMENT PRIMARY KEY ,
            sender INT (11) ,
            receiver INT (11) ,
            followRequestTime DATETIME DEFAULT CURRENT_TIMESTAMP ,
            followStatus VARCHAR (50) DEFAULT NULL 
            
        )");
        $stmt->execute();       
   }
   
   public function drop()
    {
        $stmt = Application::$app->db->pdo->prepare(
            " DROP TABLE IF EXISTS app_users_follow"
        );
        $stmt->execute();
    }

}