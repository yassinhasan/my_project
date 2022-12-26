<?php namespace core\models;
use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
use core\app\Application;
class notificationModel extends abstractModel
{
    public function rules()
    {
        return [];
    }
    
    
    public function addNotification($fromId , $to = []  , $postUserId , $postId  , $userName)
    {
        $notificationId = null;
        if ($this->data([
            "type"   => "post" 
            ])->insert("app_notifications"))
            {
               
               $notificationId =  Application::$app->db::lastId();
               for($i = 0 ; $i < count($to) ; $i++)
               {
                   $this->data([
                    "notificationId" => $notificationId ,
                    "fromId" => $fromId , 
                    "fromUsername" => $userName , 
                    "toId"  => $to[$i] ,
                    "isSeen" => "false" ,
                    "postId" => $postId  
                    ])->insert("app_notifications_comments");
               }
               
               
            }
            return  $notificationId;
            
    }
    public function getNotifications( $userId )
    {
              return  $this->from("app_notifications")->join("
                
                INNER JOIN app_notifications_comments on 
                app_notifications_comments.notificationId = app_notifications.id
                ")->where("app_notifications_comments.fromId != ?  AND app_notifications_comments.toId = ? AND app_notifications_comments.isSeen  = ? " , [$userId , $userId , "false"] )->order( " ORDER BY  app_notifications.notificationDate DESC ")->limit( " LIMIT 10 ")->select("  app_notifications.*  , app_notifications_comments.* 
                " )->fetchAll();
    }
   public function updateNotification($notificationId , $userId)
    {
        $count =  $this->from(" app_notifications_comments " )
         ->where("app_notifications_comments.notificationId = ? And app_notifications_comments.toId = ? " , [$notificationId , $userId ])
         ->delete();

        return $count > 0;
    }
    public function addChatNotification($fromId , $to  , $chatId , $userName)
    {
        $notificationId = null;
        if ($this->data([
            "type"   => "chat" 
            ])->insert("app_notifications"))
            {
               
               $notificationId =  Application::$app->db::lastId();
               $this->data([
                    "notificationId" => $notificationId ,
                    "fromId" => $fromId , 
                    "fromUsername" => $userName , 
                    "toId"  => $to ,
                    "isSeen" => "false" ,
                    "ChatId" => $chatId  
                    ])->insert("app_notifications_chat");
               }
            return  $notificationId;
            
    }
    
}
