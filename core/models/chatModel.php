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
        
         
     }else
     {
         $this->data([
            "msg" => $this->msg ,
            "fromId"  => $this->fromId ,
            "toId"  =>$this->toId , 
            "ChatId" => $ChatId
             ])->insert(self::$tableName);   
     }
      return  $ChatId ;
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
    
    

    

}
