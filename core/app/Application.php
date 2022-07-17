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
    public  $db;
    public $customExceptions;
    public static $app;
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
        $this->db      = new Database($config);
        $this->migrations = new MigrationsClass();
        $this->customExceptions  = new customExceptions();
    }

    public function run()
    {
        $access = new accessController();
        $access->isLogged();
        $this->response->resolve();
    }
}