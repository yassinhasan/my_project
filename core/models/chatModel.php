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

    public function insertMsg()
    {
      if($this->data([
            "msg" => $this->msg ,
            "fromId"  => $this->fromId ,
            "toId"  =>$this->toId
      ])->insert(self::$tableName));
      return Application::$app->db::lastId();
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
        $msgs = $this->from(self::$tableName)
        ->where(" (fromId = ?  AND  toId = ?) OR (fromId = ?  AND  toId = ?)  " , [
            $data["fromId"] ,  $data["toId"] ,  $data["toId"] ,  $data["fromId"]
        ])->select(" *  ")->fetchAll();
        return $msgs;
    }
    
    
    public function fetchChatUsers($userId)
    {
        $Users = $this->from(" app_users " )->join(" 
            INNER JOIN app_user_profile  ON 
            app_user_profile.userId = app_users.id
            ")->where("app_users.id != ? " , $userId)->select("
            app_users.id , app_users.firstName , app_users.lastName , app_users.userStatus , app_user_profile.profileImage  ,
            ( select followStatus from app_users_follow where sender = $userId and receiver = app_users.id ) as followStatus  ,
              ( select COUNT(app_users_follow.receiver) from app_users_follow where receiver = app_users.id AND followStatus = 'approve') as followers  ,
              (SELECT msg from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as lastMmsg ,
               (SELECT fromId from app_chat WHERE (fromId = $userId AND toId = app_users.id) or ( fromId = app_users.id AND toId = $userId )  ORDER BY msgDate DESC limit 1 ) as fromId
            ")->fetchAll();

        return $Users;
        

    }
}
