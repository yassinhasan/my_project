<?php 
namespace core\app;
class Router 
{
    
    public $routes = [];
   
    
    public function get($path , $callback)
    {
        if(Application::$app->request->isGet())
        {
              $this->routes["get"][$path] = $callback;
        }
    }
    public function post($path , $callback)
    {
        if(Application::$app->request->isPost())
        {
              $this->routes["post"][$path] = $callback;
        }
    }






}

