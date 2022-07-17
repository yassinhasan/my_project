<?php
namespace core\app;
class Response
{
    protected $allLayout = [
        "layoutStart" , 
        "headerLinks" , 
        "bodyStart" , 
        "nav" ,
        "content",
        "footerLinks" ,
        "bodyEnd"
    ];

    public $session;
    public $router;
    public $request;
    public $validate;
    public  $view;

    public function __construct()
    {
        $this->session =  Application::$app->session;
        $this->router =  Application::$app->router;
        $this->request =  Application::$app->request;
        $this->view =  Application::$app->view;
        $this->validate =  Application::$app->validate;
    }

    // callback here like home or register 
    // i will get it from array like this $routes["get"][home] => $callback
    private function prepareCallback()
    {
        $path = $this->request->getPath();
        $method = strtolower($this->request->getMethod());
        if($path == "")
        {
            $path = "/";
        }
        if(array_key_exists($path , $this->router->routes[$method]))
        {
              
            $callback =  $this->router->routes[$method][$path];
        }
        else
        {
            http_response_code(404);
            $callback  =  $this->router->routes[$method]["/notfound"];
        }
        return $callback;
    }
    public function resolve()
    {
        
        $callback = $this->prepareCallback();
        if(is_string($callback))
        {
            $this->renderView($callback);
        }
        if(is_array($callback))
        {
            $callback[0] = new $callback[0];
            return call_user_func($callback);
        }
    }

    // render main content like header - body -navbar - sidebar - footer
    public function renderMainLayout(  $exception=[] , $data = [])
    {
        extract($data);
        ob_start();
        foreach($this->allLayout as $layout) 
        {
            if(in_array($layout,$exception))
            {
              continue;
            }
            require_once APP_LAYOUT_PATH.$layout.".php";
        }
        return ob_get_clean();      
    }

    // render content of each  page like home or register
    public function renderContent($Content , $data = [])
    {
        extract($data);
        ob_start();
        require_once APP_VIEW."$Content.php";  
        return ob_get_clean();       
    }

    // redner all main layout and content 
    public function renderView($callback , $data =[] ,$exception=[])
    {
        $layout =  $this->renderMainLayout($exception , $data);
        $view =  $this->renderContent($callback , $data);
        $output = str_replace("{{content}}" , $view , $layout);
        echo $output;
    }

    public function redirect($url)
    {
        return header("Location: $url");
    }
}
?>