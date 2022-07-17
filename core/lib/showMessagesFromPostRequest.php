<?php
namespace core\lib;
trait showMessagesFromPostRequest
{
    public $msgs = [];
    public function setResultMessages($key , $value)
    {
    
       if(!empty($this->msgs))
       {
           array_push($this->msgs , [$key=>$value]); 
       }else
       {
           $this->msgs[$key] = $value;
       } 
    }


    public function handleJsonMessages()
    {
        foreach($this->msgs as $key=>$value)
        {
            if($key == 'success')
            {
                echo "
                `<div `
                ";
            }elseif($key == 'errors')
            {
                echo 'errors';
            }
        }
    }


}