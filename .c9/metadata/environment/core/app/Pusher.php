{"filter":false,"title":"Pusher.php","tooltip":"/core/app/Pusher.php","undoManager":{"mark":100,"position":100,"stack":[[{"start":{"row":5,"column":32},"end":{"row":5,"column":36},"action":"remove","lines":["arra"],"id":8},{"start":{"row":5,"column":32},"end":{"row":5,"column":37},"action":"insert","lines":["array"]}],[{"start":{"row":5,"column":37},"end":{"row":5,"column":39},"action":"insert","lines":["()"],"id":9}],[{"start":{"row":5,"column":38},"end":{"row":5,"column":39},"action":"insert","lines":["$"],"id":10},{"start":{"row":5,"column":39},"end":{"row":5,"column":40},"action":"insert","lines":["c"]},{"start":{"row":5,"column":40},"end":{"row":5,"column":41},"action":"insert","lines":["o"]},{"start":{"row":5,"column":41},"end":{"row":5,"column":42},"action":"insert","lines":["n"]},{"start":{"row":5,"column":42},"end":{"row":5,"column":43},"action":"insert","lines":["f"]}],[{"start":{"row":5,"column":43},"end":{"row":5,"column":44},"action":"insert","lines":["i"],"id":11},{"start":{"row":5,"column":44},"end":{"row":5,"column":45},"action":"insert","lines":["g"]}],[{"start":{"row":14,"column":0},"end":{"row":89,"column":1},"action":"remove","lines":["    // callback here like home or register ","    // i will get it from array like this $routes[\"get\"][home] => $callback","    private function prepareCallback()","    {","        $path = $this->request->getPath();","        $method = strtolower($this->request->getMethod());","        if($path == \"\")","        {","            $path = \"/\";","        }","        if(array_key_exists($path , $this->router->routes[$method]))","        {","              ","            $callback =  $this->router->routes[$method][$path];","        }","        else","        {","            http_response_code(404);","            $callback  =  $this->router->routes[$method][\"/notfound\"];","        }","        return $callback;","    }","    public function resolve()","    {","        ","        $callback = $this->prepareCallback();","        if(is_string($callback))","        {","            $this->renderView($callback);","        }","        if(is_array($callback))","        {","            $callback[0] = new $callback[0];","            return call_user_func($callback);","        }","    }","","    // render main content like header - body -navbar - sidebar - footer","    public function renderMainLayout(  $exception=[] , $data = [])","    {","        extract($data);","        ob_start();","        foreach($this->allLayout as $layout) ","        {","            if(in_array($layout,$exception))","            {","              continue;","            }","            require_once APP_LAYOUT_PATH.$layout.\".php\";","        }","        return ob_get_clean();      ","    }","","    // render content of each  page like home or register","    public function renderContent($Content , $data = [])","    {","        extract($data);","        ob_start();","        require_once APP_VIEW.\"$Content.php\";  ","        return ob_get_clean();       ","    }","","    // redner all main layout and content ","    public function renderView($callback , $data =[] ,$exception=[])","    {","        $layout =  $this->renderMainLayout($exception , $data);","        $view =  $this->renderContent($callback , $data);","        $output = str_replace(\"{{content}}\" , $view , $layout);","        echo $output;","    }","","    public function redirect($url)","    {","        return header(\"Location: $url\");","    }","}"],"id":12}],[{"start":{"row":4,"column":0},"end":{"row":5,"column":0},"action":"insert","lines":["",""],"id":13},{"start":{"row":5,"column":0},"end":{"row":5,"column":1},"action":"insert","lines":["p"]},{"start":{"row":5,"column":1},"end":{"row":5,"column":2},"action":"insert","lines":["r"]},{"start":{"row":5,"column":2},"end":{"row":5,"column":3},"action":"insert","lines":["i"]}],[{"start":{"row":5,"column":2},"end":{"row":5,"column":3},"action":"remove","lines":["i"],"id":14},{"start":{"row":5,"column":1},"end":{"row":5,"column":2},"action":"remove","lines":["r"]}],[{"start":{"row":5,"column":0},"end":{"row":5,"column":1},"action":"remove","lines":["p"],"id":15},{"start":{"row":5,"column":0},"end":{"row":5,"column":5},"action":"insert","lines":["print"]}],[{"start":{"row":5,"column":4},"end":{"row":5,"column":5},"action":"remove","lines":["t"],"id":16},{"start":{"row":5,"column":3},"end":{"row":5,"column":4},"action":"remove","lines":["n"]},{"start":{"row":5,"column":2},"end":{"row":5,"column":3},"action":"remove","lines":["i"]},{"start":{"row":5,"column":1},"end":{"row":5,"column":2},"action":"remove","lines":["r"]},{"start":{"row":5,"column":0},"end":{"row":5,"column":1},"action":"remove","lines":["p"]}],[{"start":{"row":5,"column":0},"end":{"row":5,"column":4},"action":"insert","lines":["    "],"id":17}],[{"start":{"row":5,"column":4},"end":{"row":5,"column":5},"action":"insert","lines":["p"],"id":18},{"start":{"row":5,"column":5},"end":{"row":5,"column":6},"action":"insert","lines":["r"]},{"start":{"row":5,"column":6},"end":{"row":5,"column":7},"action":"insert","lines":["i"]},{"start":{"row":5,"column":7},"end":{"row":5,"column":8},"action":"insert","lines":["v"]},{"start":{"row":5,"column":8},"end":{"row":5,"column":9},"action":"insert","lines":["a"]}],[{"start":{"row":5,"column":4},"end":{"row":5,"column":9},"action":"remove","lines":["priva"],"id":19},{"start":{"row":5,"column":4},"end":{"row":5,"column":11},"action":"insert","lines":["private"]}],[{"start":{"row":5,"column":11},"end":{"row":5,"column":12},"action":"insert","lines":[" "],"id":20},{"start":{"row":5,"column":12},"end":{"row":5,"column":13},"action":"insert","lines":["$"]},{"start":{"row":5,"column":13},"end":{"row":5,"column":14},"action":"insert","lines":["c"]}],[{"start":{"row":5,"column":13},"end":{"row":5,"column":14},"action":"remove","lines":["c"],"id":21},{"start":{"row":5,"column":12},"end":{"row":5,"column":13},"action":"remove","lines":["$"]}],[{"start":{"row":5,"column":12},"end":{"row":5,"column":13},"action":"insert","lines":["E"],"id":22}],[{"start":{"row":5,"column":12},"end":{"row":5,"column":13},"action":"remove","lines":["E"],"id":23}],[{"start":{"row":5,"column":12},"end":{"row":5,"column":13},"action":"insert","lines":["a"],"id":24},{"start":{"row":5,"column":13},"end":{"row":5,"column":14},"action":"insert","lines":["r"]},{"start":{"row":5,"column":14},"end":{"row":5,"column":15},"action":"insert","lines":["r"]}],[{"start":{"row":5,"column":12},"end":{"row":5,"column":15},"action":"remove","lines":["arr"],"id":25},{"start":{"row":5,"column":12},"end":{"row":5,"column":17},"action":"insert","lines":["array"]}],[{"start":{"row":5,"column":17},"end":{"row":5,"column":18},"action":"insert","lines":[" "],"id":26},{"start":{"row":5,"column":18},"end":{"row":5,"column":19},"action":"insert","lines":["$"]},{"start":{"row":5,"column":19},"end":{"row":5,"column":20},"action":"insert","lines":["c"]},{"start":{"row":5,"column":20},"end":{"row":5,"column":21},"action":"insert","lines":["o"]}],[{"start":{"row":5,"column":18},"end":{"row":5,"column":21},"action":"remove","lines":["$co"],"id":27},{"start":{"row":5,"column":18},"end":{"row":5,"column":25},"action":"insert","lines":["$config"]}],[{"start":{"row":5,"column":25},"end":{"row":5,"column":26},"action":"insert","lines":[";"],"id":28}],[{"start":{"row":5,"column":25},"end":{"row":5,"column":26},"action":"insert","lines":["="],"id":29}],[{"start":{"row":5,"column":26},"end":{"row":5,"column":27},"action":"insert","lines":[" "],"id":30}],[{"start":{"row":5,"column":27},"end":{"row":5,"column":29},"action":"insert","lines":["[]"],"id":31}],[{"start":{"row":5,"column":12},"end":{"row":5,"column":17},"action":"remove","lines":["array"],"id":32}],[{"start":{"row":6,"column":32},"end":{"row":6,"column":37},"action":"remove","lines":["array"],"id":33}],[{"start":{"row":6,"column":32},"end":{"row":6,"column":33},"action":"remove","lines":["("],"id":34}],[{"start":{"row":6,"column":39},"end":{"row":6,"column":40},"action":"remove","lines":[")"],"id":35}],[{"start":{"row":8,"column":0},"end":{"row":12,"column":55},"action":"remove","lines":["        $this->session =  Application::$app->session;","        $this->router =  Application::$app->router;","        $this->request =  Application::$app->request;","        $this->view =  Application::$app->view;","        $this->validate =  Application::$app->validate;"],"id":36}],[{"start":{"row":8,"column":0},"end":{"row":8,"column":4},"action":"insert","lines":["    "],"id":37}],[{"start":{"row":8,"column":4},"end":{"row":8,"column":8},"action":"insert","lines":["    "],"id":38}],[{"start":{"row":8,"column":8},"end":{"row":8,"column":9},"action":"insert","lines":["$"],"id":39},{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"insert","lines":["T"]},{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"insert","lines":["h"]}],[{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"remove","lines":["h"],"id":40},{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"remove","lines":["T"]}],[{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"insert","lines":["T"],"id":41},{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"insert","lines":["H"]}],[{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"remove","lines":["H"],"id":42},{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"remove","lines":["T"]}],[{"start":{"row":8,"column":9},"end":{"row":8,"column":10},"action":"insert","lines":["t"],"id":43},{"start":{"row":8,"column":10},"end":{"row":8,"column":11},"action":"insert","lines":["h"]},{"start":{"row":8,"column":11},"end":{"row":8,"column":12},"action":"insert","lines":["i"]},{"start":{"row":8,"column":12},"end":{"row":8,"column":13},"action":"insert","lines":["s"]},{"start":{"row":8,"column":13},"end":{"row":8,"column":14},"action":"insert","lines":["-"]}],[{"start":{"row":8,"column":14},"end":{"row":8,"column":15},"action":"insert","lines":[">"],"id":44}],[{"start":{"row":8,"column":15},"end":{"row":8,"column":21},"action":"insert","lines":["config"],"id":45}],[{"start":{"row":8,"column":21},"end":{"row":8,"column":22},"action":"insert","lines":[" "],"id":46},{"start":{"row":8,"column":22},"end":{"row":8,"column":23},"action":"insert","lines":["="]}],[{"start":{"row":8,"column":23},"end":{"row":8,"column":24},"action":"insert","lines":[" "],"id":47},{"start":{"row":8,"column":24},"end":{"row":8,"column":25},"action":"insert","lines":["$"]},{"start":{"row":8,"column":25},"end":{"row":8,"column":26},"action":"insert","lines":["c"]}],[{"start":{"row":8,"column":24},"end":{"row":8,"column":26},"action":"remove","lines":["$c"],"id":48},{"start":{"row":8,"column":24},"end":{"row":8,"column":31},"action":"insert","lines":["$config"]}],[{"start":{"row":8,"column":31},"end":{"row":8,"column":32},"action":"insert","lines":[";"],"id":49}],[{"start":{"row":8,"column":32},"end":{"row":9,"column":0},"action":"insert","lines":["",""],"id":50},{"start":{"row":9,"column":0},"end":{"row":9,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":12,"column":0},"end":{"row":12,"column":1},"action":"insert","lines":["}"],"id":51}],[{"start":{"row":8,"column":32},"end":{"row":9,"column":0},"action":"insert","lines":["",""],"id":52},{"start":{"row":9,"column":0},"end":{"row":9,"column":8},"action":"insert","lines":["        "]}],[{"start":{"row":9,"column":8},"end":{"row":18,"column":4},"action":"insert","lines":[" $options = array(","    'cluster' => $_ENV['APP_CLUSTER'],","    'useTLS' => true","  );","  $pusher = new Pusher\\Pusher(","    $_ENV['APP_KEY'],","    $_ENV['APP_SECRET'],","    $_ENV['APP_ID'],","    $options","  );"],"id":53}],[{"start":{"row":13,"column":0},"end":{"row":13,"column":4},"action":"insert","lines":["    "],"id":54},{"start":{"row":14,"column":0},"end":{"row":14,"column":4},"action":"insert","lines":["    "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":4},"action":"insert","lines":["    "]},{"start":{"row":16,"column":0},"end":{"row":16,"column":4},"action":"insert","lines":["    "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":4},"action":"insert","lines":["    "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":10,"column":0},"end":{"row":10,"column":4},"action":"insert","lines":["    "],"id":55},{"start":{"row":11,"column":0},"end":{"row":11,"column":4},"action":"insert","lines":["    "]},{"start":{"row":12,"column":0},"end":{"row":12,"column":4},"action":"insert","lines":["    "]}],[{"start":{"row":10,"column":21},"end":{"row":10,"column":26},"action":"remove","lines":["$_ENV"],"id":56},{"start":{"row":10,"column":21},"end":{"row":10,"column":28},"action":"insert","lines":["$config"]}],[{"start":{"row":14,"column":8},"end":{"row":14,"column":13},"action":"remove","lines":["$_ENV"],"id":57},{"start":{"row":14,"column":8},"end":{"row":14,"column":15},"action":"insert","lines":["$config"]}],[{"start":{"row":15,"column":9},"end":{"row":15,"column":13},"action":"remove","lines":["_ENV"],"id":58},{"start":{"row":15,"column":9},"end":{"row":15,"column":16},"action":"insert","lines":["$config"]}],[{"start":{"row":15,"column":8},"end":{"row":15,"column":9},"action":"remove","lines":["$"],"id":59}],[{"start":{"row":16,"column":8},"end":{"row":16,"column":13},"action":"remove","lines":["$_ENV"],"id":60},{"start":{"row":16,"column":8},"end":{"row":16,"column":15},"action":"insert","lines":["$config"]}],[{"start":{"row":10,"column":30},"end":{"row":10,"column":41},"action":"remove","lines":["APP_CLUSTER"],"id":61},{"start":{"row":10,"column":30},"end":{"row":10,"column":41},"action":"insert","lines":["app_cluster"]}],[{"start":{"row":13,"column":5},"end":{"row":13,"column":6},"action":"insert","lines":["r"],"id":62},{"start":{"row":13,"column":6},"end":{"row":13,"column":7},"action":"insert","lines":["e"]},{"start":{"row":13,"column":7},"end":{"row":13,"column":8},"action":"insert","lines":["t"]},{"start":{"row":13,"column":8},"end":{"row":13,"column":9},"action":"insert","lines":["u"]},{"start":{"row":13,"column":9},"end":{"row":13,"column":10},"action":"insert","lines":["r"]},{"start":{"row":13,"column":10},"end":{"row":13,"column":11},"action":"insert","lines":["n"]}],[{"start":{"row":13,"column":11},"end":{"row":13,"column":12},"action":"insert","lines":[" "],"id":63}],[{"start":{"row":5,"column":25},"end":{"row":6,"column":0},"action":"insert","lines":["",""],"id":64},{"start":{"row":6,"column":0},"end":{"row":6,"column":4},"action":"insert","lines":["    "]},{"start":{"row":6,"column":4},"end":{"row":6,"column":5},"action":"insert","lines":["p"]},{"start":{"row":6,"column":5},"end":{"row":6,"column":6},"action":"insert","lines":["r"]}],[{"start":{"row":6,"column":5},"end":{"row":6,"column":6},"action":"remove","lines":["r"],"id":65}],[{"start":{"row":6,"column":5},"end":{"row":6,"column":6},"action":"insert","lines":["u"],"id":66},{"start":{"row":6,"column":6},"end":{"row":6,"column":7},"action":"insert","lines":["b"]}],[{"start":{"row":6,"column":4},"end":{"row":6,"column":7},"action":"remove","lines":["pub"],"id":67},{"start":{"row":6,"column":4},"end":{"row":6,"column":10},"action":"insert","lines":["public"]}],[{"start":{"row":6,"column":10},"end":{"row":6,"column":11},"action":"insert","lines":[" "],"id":68},{"start":{"row":6,"column":11},"end":{"row":6,"column":12},"action":"insert","lines":["$"]},{"start":{"row":6,"column":12},"end":{"row":6,"column":13},"action":"insert","lines":["p"]}],[{"start":{"row":6,"column":13},"end":{"row":6,"column":14},"action":"insert","lines":["u"],"id":69},{"start":{"row":6,"column":14},"end":{"row":6,"column":15},"action":"insert","lines":["s"]},{"start":{"row":6,"column":15},"end":{"row":6,"column":16},"action":"insert","lines":["h"]},{"start":{"row":6,"column":16},"end":{"row":6,"column":17},"action":"insert","lines":["e"]},{"start":{"row":6,"column":17},"end":{"row":6,"column":18},"action":"insert","lines":["r"]}],[{"start":{"row":6,"column":18},"end":{"row":6,"column":19},"action":"insert","lines":[";"],"id":70}],[{"start":{"row":21,"column":5},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":71},{"start":{"row":22,"column":0},"end":{"row":22,"column":4},"action":"insert","lines":["    "]},{"start":{"row":22,"column":4},"end":{"row":22,"column":5},"action":"insert","lines":["p"]},{"start":{"row":22,"column":5},"end":{"row":22,"column":6},"action":"insert","lines":["u"]},{"start":{"row":22,"column":6},"end":{"row":22,"column":7},"action":"insert","lines":["b"]}],[{"start":{"row":22,"column":4},"end":{"row":22,"column":7},"action":"remove","lines":["pub"],"id":72},{"start":{"row":22,"column":4},"end":{"row":22,"column":10},"action":"insert","lines":["public"]}],[{"start":{"row":22,"column":10},"end":{"row":22,"column":11},"action":"insert","lines":[" "],"id":73},{"start":{"row":22,"column":11},"end":{"row":22,"column":12},"action":"insert","lines":["f"]},{"start":{"row":22,"column":12},"end":{"row":22,"column":13},"action":"insert","lines":["u"]},{"start":{"row":22,"column":13},"end":{"row":22,"column":14},"action":"insert","lines":["b"]},{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"insert","lines":["c"]}],[{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"remove","lines":["c"],"id":74},{"start":{"row":22,"column":13},"end":{"row":22,"column":14},"action":"remove","lines":["b"]}],[{"start":{"row":22,"column":13},"end":{"row":22,"column":14},"action":"insert","lines":["n"],"id":75},{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"insert","lines":["c"]}],[{"start":{"row":22,"column":11},"end":{"row":22,"column":15},"action":"remove","lines":["func"],"id":76},{"start":{"row":22,"column":11},"end":{"row":22,"column":19},"action":"insert","lines":["function"]}],[{"start":{"row":22,"column":19},"end":{"row":22,"column":20},"action":"insert","lines":[" "],"id":77},{"start":{"row":22,"column":20},"end":{"row":22,"column":21},"action":"insert","lines":["p"]},{"start":{"row":22,"column":21},"end":{"row":22,"column":22},"action":"insert","lines":["u"]},{"start":{"row":22,"column":22},"end":{"row":22,"column":23},"action":"insert","lines":["s"]}],[{"start":{"row":22,"column":23},"end":{"row":22,"column":24},"action":"insert","lines":["h"],"id":78}],[{"start":{"row":22,"column":20},"end":{"row":22,"column":24},"action":"remove","lines":["push"],"id":79},{"start":{"row":22,"column":20},"end":{"row":22,"column":26},"action":"insert","lines":["pusher"]}],[{"start":{"row":22,"column":26},"end":{"row":22,"column":28},"action":"insert","lines":["()"],"id":80}],[{"start":{"row":22,"column":28},"end":{"row":23,"column":0},"action":"insert","lines":["",""],"id":81},{"start":{"row":23,"column":0},"end":{"row":23,"column":4},"action":"insert","lines":["    "]},{"start":{"row":23,"column":4},"end":{"row":23,"column":5},"action":"insert","lines":["{"]},{"start":{"row":23,"column":5},"end":{"row":23,"column":6},"action":"insert","lines":["}"]}],[{"start":{"row":23,"column":5},"end":{"row":25,"column":4},"action":"insert","lines":["","        ","    "],"id":82}],[{"start":{"row":9,"column":0},"end":{"row":19,"column":8},"action":"remove","lines":["        $this->config = $config;","         $options = array(","        'cluster' => $config['app_cluster'],","        'useTLS' => true","      );","     return  $pusher = new Pusher\\Pusher(","        $config['APP_KEY'],","        $config['APP_SECRET'],","        $config['APP_ID'],","        $options","      );"],"id":83}],[{"start":{"row":14,"column":8},"end":{"row":24,"column":8},"action":"insert","lines":["        $this->config = $config;","         $options = array(","        'cluster' => $config['app_cluster'],","        'useTLS' => true","      );","     return  $pusher = new Pusher\\Pusher(","        $config['APP_KEY'],","        $config['APP_SECRET'],","        $config['APP_ID'],","        $options","      );"],"id":84}],[{"start":{"row":14,"column":6},"end":{"row":14,"column":16},"action":"remove","lines":["          "],"id":85}],[{"start":{"row":15,"column":8},"end":{"row":15,"column":9},"action":"remove","lines":[" "],"id":86},{"start":{"row":15,"column":4},"end":{"row":15,"column":8},"action":"remove","lines":["    "]}],[{"start":{"row":15,"column":4},"end":{"row":15,"column":5},"action":"insert","lines":[" "],"id":87},{"start":{"row":15,"column":5},"end":{"row":15,"column":6},"action":"insert","lines":[" "]},{"start":{"row":15,"column":6},"end":{"row":15,"column":7},"action":"insert","lines":[" "]}],[{"start":{"row":9,"column":0},"end":{"row":9,"column":4},"action":"insert","lines":["    "],"id":88}],[{"start":{"row":9,"column":4},"end":{"row":9,"column":8},"action":"insert","lines":["    "],"id":89}],[{"start":{"row":9,"column":8},"end":{"row":9,"column":9},"action":"insert","lines":["$"],"id":90},{"start":{"row":9,"column":9},"end":{"row":9,"column":10},"action":"insert","lines":["t"]},{"start":{"row":9,"column":10},"end":{"row":9,"column":11},"action":"insert","lines":["h"]}],[{"start":{"row":9,"column":8},"end":{"row":9,"column":11},"action":"remove","lines":["$th"],"id":91},{"start":{"row":9,"column":8},"end":{"row":9,"column":13},"action":"insert","lines":["$this"]}],[{"start":{"row":9,"column":13},"end":{"row":9,"column":14},"action":"insert","lines":["-"],"id":92},{"start":{"row":9,"column":14},"end":{"row":9,"column":15},"action":"insert","lines":[">"]},{"start":{"row":9,"column":15},"end":{"row":9,"column":16},"action":"insert","lines":["c"]}],[{"start":{"row":9,"column":15},"end":{"row":9,"column":16},"action":"remove","lines":["c"],"id":93},{"start":{"row":9,"column":15},"end":{"row":9,"column":21},"action":"insert","lines":["config"]}],[{"start":{"row":9,"column":21},"end":{"row":9,"column":22},"action":"insert","lines":[" "],"id":94},{"start":{"row":9,"column":22},"end":{"row":9,"column":23},"action":"insert","lines":["="]}],[{"start":{"row":9,"column":23},"end":{"row":9,"column":24},"action":"insert","lines":[" "],"id":95},{"start":{"row":9,"column":24},"end":{"row":9,"column":25},"action":"insert","lines":["$"]},{"start":{"row":9,"column":25},"end":{"row":9,"column":26},"action":"insert","lines":["c"]},{"start":{"row":9,"column":26},"end":{"row":9,"column":27},"action":"insert","lines":["v"]}],[{"start":{"row":9,"column":26},"end":{"row":9,"column":27},"action":"remove","lines":["v"],"id":96},{"start":{"row":9,"column":25},"end":{"row":9,"column":26},"action":"remove","lines":["c"]}],[{"start":{"row":9,"column":25},"end":{"row":9,"column":26},"action":"insert","lines":["c"],"id":97},{"start":{"row":9,"column":26},"end":{"row":9,"column":27},"action":"insert","lines":["o"]}],[{"start":{"row":9,"column":24},"end":{"row":9,"column":27},"action":"remove","lines":["$co"],"id":98},{"start":{"row":9,"column":24},"end":{"row":9,"column":31},"action":"insert","lines":["$config"]}],[{"start":{"row":9,"column":31},"end":{"row":9,"column":32},"action":"insert","lines":[";"],"id":99}],[{"start":{"row":12,"column":20},"end":{"row":12,"column":26},"action":"remove","lines":["pusher"],"id":100},{"start":{"row":12,"column":20},"end":{"row":12,"column":21},"action":"insert","lines":["g"]},{"start":{"row":12,"column":21},"end":{"row":12,"column":22},"action":"insert","lines":["e"]},{"start":{"row":12,"column":22},"end":{"row":12,"column":23},"action":"insert","lines":["t"]},{"start":{"row":12,"column":23},"end":{"row":12,"column":24},"action":"insert","lines":["O"]}],[{"start":{"row":12,"column":23},"end":{"row":12,"column":24},"action":"remove","lines":["O"],"id":101}],[{"start":{"row":12,"column":23},"end":{"row":12,"column":24},"action":"insert","lines":["P"],"id":102},{"start":{"row":12,"column":24},"end":{"row":12,"column":25},"action":"insert","lines":["u"]},{"start":{"row":12,"column":25},"end":{"row":12,"column":26},"action":"insert","lines":["s"]},{"start":{"row":12,"column":26},"end":{"row":12,"column":27},"action":"insert","lines":["h"]},{"start":{"row":12,"column":27},"end":{"row":12,"column":28},"action":"insert","lines":["e"]},{"start":{"row":12,"column":28},"end":{"row":12,"column":29},"action":"insert","lines":["r"]}],[{"start":{"row":16,"column":21},"end":{"row":16,"column":28},"action":"remove","lines":["$config"],"id":104},{"start":{"row":16,"column":21},"end":{"row":16,"column":34},"action":"insert","lines":["$this->config"]}],[{"start":{"row":20,"column":8},"end":{"row":20,"column":15},"action":"remove","lines":["$config"],"id":105},{"start":{"row":20,"column":8},"end":{"row":20,"column":21},"action":"insert","lines":["$this->config"]}],[{"start":{"row":21,"column":8},"end":{"row":21,"column":15},"action":"remove","lines":["$config"],"id":106},{"start":{"row":21,"column":8},"end":{"row":21,"column":21},"action":"insert","lines":["$this->config"]}],[{"start":{"row":22,"column":8},"end":{"row":22,"column":15},"action":"remove","lines":["$config"],"id":107},{"start":{"row":22,"column":8},"end":{"row":22,"column":21},"action":"insert","lines":["$this->config"]}],[{"start":{"row":14,"column":0},"end":{"row":14,"column":30},"action":"remove","lines":["      $this->config = $config;"],"id":108}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":3},"action":"insert","lines":["// "],"id":109},{"start":{"row":1,"column":0},"end":{"row":1,"column":3},"action":"insert","lines":["// "]},{"start":{"row":2,"column":0},"end":{"row":2,"column":3},"action":"insert","lines":["// "]},{"start":{"row":3,"column":0},"end":{"row":3,"column":3},"action":"insert","lines":["// "]},{"start":{"row":5,"column":0},"end":{"row":5,"column":3},"action":"insert","lines":["// "]},{"start":{"row":6,"column":0},"end":{"row":6,"column":3},"action":"insert","lines":["// "]},{"start":{"row":7,"column":0},"end":{"row":7,"column":3},"action":"insert","lines":["// "]},{"start":{"row":8,"column":0},"end":{"row":8,"column":3},"action":"insert","lines":["// "]},{"start":{"row":9,"column":0},"end":{"row":9,"column":3},"action":"insert","lines":["// "]},{"start":{"row":11,"column":0},"end":{"row":11,"column":3},"action":"insert","lines":["// "]},{"start":{"row":12,"column":0},"end":{"row":12,"column":3},"action":"insert","lines":["// "]},{"start":{"row":13,"column":0},"end":{"row":13,"column":3},"action":"insert","lines":["// "]},{"start":{"row":15,"column":0},"end":{"row":15,"column":2},"action":"insert","lines":["//"]},{"start":{"row":16,"column":0},"end":{"row":16,"column":3},"action":"insert","lines":["// "]},{"start":{"row":17,"column":0},"end":{"row":17,"column":3},"action":"insert","lines":["// "]},{"start":{"row":18,"column":0},"end":{"row":18,"column":3},"action":"insert","lines":["// "]},{"start":{"row":19,"column":0},"end":{"row":19,"column":3},"action":"insert","lines":["// "]},{"start":{"row":20,"column":0},"end":{"row":20,"column":3},"action":"insert","lines":["// "]},{"start":{"row":21,"column":0},"end":{"row":21,"column":3},"action":"insert","lines":["// "]},{"start":{"row":22,"column":0},"end":{"row":22,"column":3},"action":"insert","lines":["// "]},{"start":{"row":23,"column":0},"end":{"row":23,"column":3},"action":"insert","lines":["// "]},{"start":{"row":24,"column":0},"end":{"row":24,"column":3},"action":"insert","lines":["// "]},{"start":{"row":25,"column":0},"end":{"row":25,"column":3},"action":"insert","lines":["// "]},{"start":{"row":27,"column":0},"end":{"row":27,"column":3},"action":"insert","lines":["// "]},{"start":{"row":28,"column":0},"end":{"row":28,"column":3},"action":"insert","lines":["// "]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":3},"end":{"row":28,"column":5},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1660840951784,"hash":"a45e5bb2705de1f7b312c242ab9e5ac47f213a8f"}