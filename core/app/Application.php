<?php 
namespace core\app;
use core\database\Database;
use core\database\MigrationsClass;
use core\controllers\accessController;
class Application 
{

    public $session;
    public $router;
    public $request;
    public $response;
    public $validate;
    public $view;
    public $cookie;
    public $migrations;
    public  $db = null;
    public $customExceptions;
    public static $app;
    public $Pusher;
    public function __construct(array $config)
    {   
      
        static::$app =$this;
        $this->session = new customSession();
        $this->cookie = new cookie();
        $this->request = new Rrequest();
        $this->validate = new Validate();
        $this->view = new View();
        $this->router = new Router();
        $this->request = new Rrequest();
        $this->response = new Response();
        $databse = $config["database"];
        if($this->db == null)
        {
           $this->db = new Database($databse);  
        }
       
        $this->migrations = new MigrationsClass();
        $this->customExceptions  = new customExceptions();
        $this->pusher = $config["pusher"][0];
    }

    public function run()
    {
        $access = new accessController();
        $access->isLogged();
        $this->response->resolve();
    }
}