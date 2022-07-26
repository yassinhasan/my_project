<?php
namespace core\app;
class customExceptions 
{
    public function load(int $code ,array $message = [], $page="notfound" )
    {
        extract($message);
        http_response_code($code);
        ob_start();
        require_once(APP_VIEW.$page.".php");
        $output = ob_get_clean();
        echo $output;
    }
}