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
        /*
        
                    select * from (
                select col1, col2
                from table a
                <....>
                order by col3
                limit by 200
            ) a
            union all
            select * from (
                select cola, colb
                from table b
                <....>
                order by colb
                limit by 300
            ) b
                    
        */
            $sql = " select * 
                from (
                        (select  app_notifications_comments.*   , app_notifications.notificationDate , app_notifications.type from app_notifications
                           INNER JOIN app_notifications_comments on 
                          app_notifications_comments.notificationId = app_notifications.id
                          where app_notifications_comments.fromId != ?  AND app_notifications_comments.toId = ? AND app_notifications_comments.isSeen  = ? 
                         )
              union all
                    ( select  app_notifications_chat.* , app_notifications.notificationDate , app_notifications.type from app_notifications 
                       INNER JOIN app_notifications_chat on 
                        app_notifications_chat.notificationId = app_notifications.id
                       where app_notifications_chat.fromId != ?  AND app_notifications_chat.toId = ? AND app_notifications_chat.isSeen  = ? 
                     ) 
                ) as results
                    ORDER BY  notificationDate DESC  LIMIT 10


                ";
            $stmt = $this->byQuery($sql ,  [$userId , $userId , "false" ,$userId , $userId , "false"]);
            return  $this->fetchAll($stmt);
                // )->order( " ORDER BY  app_notifications.notificationDate DESC ")->limit( " LIMIT 10 ")->select("  app_notifications.*  , app_notifications_comments.* 

    }
   public function updateNotification($notificationId , $userId, $type)
    {
        $count = null;
        if($type == "post")
        {
        $count =  $this->from(" app_notifications_comments " )
         ->where("app_notifications_comments.notificationId = ? And app_notifications_comments.toId = ? " , [$notificationId , $userId ])
         ->delete();
        }elseif ($type == "chat")
        {
           $count =  $this->from(" app_notifications_chat " )
         ->where("app_notifications_chat.notificationId = ? And app_notifications_chat.toId = ? " , [$notificationId , $userId ])
         ->delete(); 
        }
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
