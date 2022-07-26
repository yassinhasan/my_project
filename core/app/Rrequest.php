<?php
namespace core\app;
class Rrequest
{
    private $get = "GET";
    private $post = "POST";
    public $currentPath = null;

    public function __construct()
    {
        $this->getPath();
    }
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public Function isGet()
    {
       return $_SERVER['REQUEST_METHOD'] == $this->get;
    }
    public Function isPost()
    {
       return $_SERVER['REQUEST_METHOD'] == $this->post;
    }

    public function get($key)
    {
        if(array_key_exists($key, $_GET))
        return $_GET[$key];
    }
    public function getPath()
    {


        $path = null;
        if(isset($_SERVER["REQUEST_URI"]))
        {

           
            $path = $_SERVER["REQUEST_URI"];
            $position = strpos($path , "?");
         
            if($position != false)
            {
              
                $path = substr($path,0,$position);
            }
            
        }
        $this->currentPath = $path;
        return $path;
    }
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getBody()
    {
        return $_POST;
    }
    public function baseUrl()
    {
        $protocol = NULL;
        if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']))
        {
           $protocol =  $_SERVER['HTTP_X_FORWARDED_PROTO'];
        }elseif(isset($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] == "off")
        {
            $protocol ="http";
        }else
        {
            $protocol = "https";
        }
        
        $http_host = $_SERVER['HTTP_HOST'] ?? null;
        $script_name = $_SERVER['SCRIPT_NAME'] ?? null;
        if($script_name)
        {
            $script_name = str_replace("index.php" , "" , $script_name);
        }
        
        if($protocol AND $http_host AND $script_name)
        {
             return $protocol."://".$http_host.$script_name;
        }
       
    }

    public function publicUrl()
    {
        return $this->baseUrl()."public/";
    }
    public function cssUrl($file)
    {
        return $this->baseUrl()."public/css/$file.css";
    }
    public function jsUrl($file)
    {
        return $this->baseUrl()."public/js/$file.js";
    }
    public function toUpladesaFile($file)
    {
        return $this->publicUrl()."uploades/$file";
    }
    public function toAdminFiles($file)
    {
        return $this->publicUrl()."uploades/images/admin/$file";
    }
    public function toHome($file)
    {
        return $this->publicUrl()."uploades/images/home/$file";
    }
} 
