<?php 
namespace core\app;

use SessionHandler;

class customSession  extends SessionHandler
{

    use encryptDecrypt; 
    const SESSIONAME = PROJECT_NAME;
    const SESSION_EXPIRE = 3600 ; // 1 hr
    const FLASH_MSG = "flash_msg";
    public function __construct()
    {

        session_name(self::SESSIONAME);
        ini_set("session.use_cookies", 1);
        ini_set("session.use_only_cookies" , 1);
        ini_set("session.use_trans_sid" , 0);
        ini_set("session.save_handler", "files");
        ini_set("session.gc_maxlifetime" , SELF::SESSION_EXPIRE);
        session_set_cookie_params(SELF::SESSION_EXPIRE);
        session_set_save_handler($this,true);
        session_start();
       if (isset( $_SESSION[self::FLASH_MSG]))
       {
        foreach($_SESSION[self::FLASH_MSG] as $key => $value)
        {
            $_SESSION[self::FLASH_MSG][$key]['remove'] = true;
        };
       }

    }
    public function setFlashMsg($key , $value)
    {
        $_SESSION[self::FLASH_MSG][$key] = [
            "remove" => false , 
            "msg"   => $value
        ];
    }

    public function hasFlashMsg($key)
    {
       if(isset($_SESSION[self::FLASH_MSG][$key]) )
       {
           return $_SESSION[self::FLASH_MSG][$key]['remove'] == true;
       }
    }
    public function getFlashMsg($key)
    {
         return $_SESSION[self::FLASH_MSG][$key]["msg"];
       
    }

    public function __set($name, $value)
    {
         $_SESSION[$name] = $value;
    }
    public function __get($name)
    {
       if(array_key_exists($name,$_SESSION))
       {
         return   $_SESSION[$name];
         
       }else
       {
           return false;
       }
    }
    public function has($key)
    {
        return array_key_exists($key,$_SESSION);
    }
    public function pull($key)
    {
        $data  = null;
        if (isset( $_SESSION[self::FLASH_MSG]))
        {
            foreach($_SESSION[self::FLASH_MSG] as $key => $value)
            {
               
                if($_SESSION[self::FLASH_MSG][$key]['remove'] == true)
                {
                    $data =  $_SESSION[self::FLASH_MSG][$key]['msg'];
                    unset($_SESSION[self::FLASH_MSG][$key]);
                }
            };
        }
        return $data;
    }
    public function getAll()
    {

        pre($_SESSION);
    }

    public function kill()
    {
        session_unset();
        session_destroy();
    }
    public function write( $id,  $data): bool
    {
        $data = $this->encrypt($data);
        
       if(  parent::write($id, $data))
       {
           return true;
       }
    }
    public function read($id): string
    {
        $data  = parent::read($id);

        if(!$data)
        {
            return "";
        }else 
        {
            return $this->decrypt($data);
        }
    }
}