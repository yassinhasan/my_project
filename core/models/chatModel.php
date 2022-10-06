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
}
