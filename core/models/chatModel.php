<?php namespace core\models;
use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
use core\app\Application;
class chatModel extends abstractModel
{
    static public $tableName = "app_chat";
    public function rules()
    {
        return [
            "msg" => [Validate::FIELD__REQUIRED] ,
            "fromId" => [Validate::FIELD__REQUIRED] ,
            "toId" => [Validate::FIELD__REQUIRED] ,
        ];
    }

    public function insertMsg($ChatId)
    {
     
     $insertNewUniqueId  = false;
     $msgId;
     if($ChatId == "null" || $ChatId == 0 || $ChatId == 0)
     {
         
         $insertNewUniqueId  = true;
     }
     if($insertNewUniqueId != false)
     {
        
           $this->data([
                  "msgDate" => date( 'Y-m-d H:i:s', time() )
                  ])->insert("app_chat_unique") ;
            $ChatId =  Application::$app->db::lastId();
            $this->data([
            "msg" => $this->msg ,
            "fromId"  => $this->fromId ,
            "toId"  =>$this->toId , 
            "ChatId" => $ChatId
             ])->insert(self::$tableName);
           $msgId =  Application::$app->db::lastId();
        
         
     }else
     {
         $this->data([
            "msg" => $this->msg ,
            "fromId"  => $this->fromId ,
            "toId"  =>$this->toId , 
            "ChatId" => $ChatId
             ])->insert(self::$tableName); 
          $msgId =  Application::$app->db::lastId();
     }
      return  [$ChatId , $msgId];
    }
    public function addAttachMsg($msgId , $attachment = null , $attachmentType =null)
    {
        $this->data([
            "msgId" =>  $msgId ,
            "attachment"   => $attachment , 
            "attachmentType"   => $attachmentType ,
        ])->insert("app_chat_attach");
        return true;
    }
    public function fetchPrivateChat($data)
    {
         $msgs = [];
         $ChatId = $data["ChatId"] ;
        if($ChatId  == 0  || $ChatId == "0" || $ChatId == "null" || $ChatId == null)
        {
           $msgs =  [];
        }else{
        $msgs = $this->from(self::$tableName)
        ->where(" chatId = ?  " , $ChatId)->order( " ORDER BY  msgDate DESC ")->limit( " LIMIT 5 ")->select(" *  ")->fetchAll();
        }
        return $msgs;
    }
    
    
    public function fetchChatUsers($userId)
    {
        $Users = $this->from(" app_users " )->join(" 
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_users.id
            ")->where("app_users.id != ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.lastName , app_users.userStatus , app_users.lastActivity , app_users.email , app_user_profile.profileImage  ,
            ( select followStatus from app_users_follow where sender = $userId and receiver = app_users.id ) as followStatus  ,
              ( select COUNT(app_users_follow.receiver) from app_users_follow where receiver = app_users.id AND followStatus = 'approve') as followers  ,
              (SELECT msg from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as lastMmsg ,
              (SELECT isSeen from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as isSeen ,
              (SELECT id from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as lastMmsgId ,
              (SELECT ChatId from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as ChatId ,
               (SELECT fromId from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as fromId
            ")->fetchAll();

        return $Users;
    }
    

}
