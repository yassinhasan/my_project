{"filter":false,"title":"homecontroller.php","tooltip":"/core/controllers/homecontroller.php","undoManager":{"mark":29,"position":29,"stack":[[{"start":{"row":229,"column":50},"end":{"row":230,"column":0},"action":"insert","lines":["",""],"id":2},{"start":{"row":230,"column":0},"end":{"row":230,"column":8},"action":"insert","lines":["        "]},{"start":{"row":230,"column":8},"end":{"row":230,"column":9},"action":"insert","lines":["$"]},{"start":{"row":230,"column":9},"end":{"row":230,"column":10},"action":"insert","lines":["t"]},{"start":{"row":230,"column":10},"end":{"row":230,"column":11},"action":"insert","lines":["y"]},{"start":{"row":230,"column":11},"end":{"row":230,"column":12},"action":"insert","lines":["p"]},{"start":{"row":230,"column":12},"end":{"row":230,"column":13},"action":"insert","lines":["e"]}],[{"start":{"row":230,"column":13},"end":{"row":230,"column":14},"action":"insert","lines":[" "],"id":3},{"start":{"row":230,"column":14},"end":{"row":230,"column":15},"action":"insert","lines":["="]}],[{"start":{"row":230,"column":15},"end":{"row":230,"column":16},"action":"insert","lines":[" "],"id":4}],[{"start":{"row":230,"column":16},"end":{"row":230,"column":17},"action":"insert","lines":["$"],"id":5},{"start":{"row":230,"column":17},"end":{"row":230,"column":18},"action":"insert","lines":["d"]},{"start":{"row":230,"column":18},"end":{"row":230,"column":19},"action":"insert","lines":["a"]}],[{"start":{"row":230,"column":16},"end":{"row":230,"column":19},"action":"remove","lines":["$da"],"id":6},{"start":{"row":230,"column":16},"end":{"row":230,"column":21},"action":"insert","lines":["$data"]}],[{"start":{"row":230,"column":21},"end":{"row":230,"column":23},"action":"insert","lines":["[]"],"id":7}],[{"start":{"row":230,"column":22},"end":{"row":230,"column":24},"action":"insert","lines":["\"\""],"id":8}],[{"start":{"row":230,"column":23},"end":{"row":230,"column":39},"action":"insert","lines":["notificationType"],"id":9}],[{"start":{"row":230,"column":41},"end":{"row":230,"column":42},"action":"insert","lines":[";"],"id":10}],[{"start":{"row":234,"column":77},"end":{"row":234,"column":78},"action":"insert","lines":[" "],"id":11},{"start":{"row":234,"column":78},"end":{"row":234,"column":79},"action":"insert","lines":[","]}],[{"start":{"row":234,"column":79},"end":{"row":234,"column":80},"action":"insert","lines":[" "],"id":12},{"start":{"row":234,"column":80},"end":{"row":234,"column":81},"action":"insert","lines":["$"]},{"start":{"row":234,"column":81},"end":{"row":234,"column":82},"action":"insert","lines":["t"]},{"start":{"row":234,"column":82},"end":{"row":234,"column":83},"action":"insert","lines":["y"]},{"start":{"row":234,"column":83},"end":{"row":234,"column":84},"action":"insert","lines":["p"]},{"start":{"row":234,"column":84},"end":{"row":234,"column":85},"action":"insert","lines":["e"]}],[{"start":{"row":236,"column":49},"end":{"row":237,"column":0},"action":"insert","lines":["",""],"id":13},{"start":{"row":237,"column":0},"end":{"row":237,"column":14},"action":"insert","lines":["              "]}],[{"start":{"row":237,"column":14},"end":{"row":237,"column":49},"action":"insert","lines":["$this->jData[\"update\"] = \"success\";"],"id":14}],[{"start":{"row":237,"column":28},"end":{"row":237,"column":34},"action":"remove","lines":["update"],"id":15},{"start":{"row":237,"column":28},"end":{"row":237,"column":29},"action":"insert","lines":["t"]},{"start":{"row":237,"column":29},"end":{"row":237,"column":30},"action":"insert","lines":["y"]},{"start":{"row":237,"column":30},"end":{"row":237,"column":31},"action":"insert","lines":["p"]},{"start":{"row":237,"column":31},"end":{"row":237,"column":32},"action":"insert","lines":["e"]}],[{"start":{"row":237,"column":38},"end":{"row":237,"column":45},"action":"remove","lines":["success"],"id":16}],[{"start":{"row":237,"column":38},"end":{"row":237,"column":39},"action":"remove","lines":["\""],"id":17},{"start":{"row":237,"column":37},"end":{"row":237,"column":38},"action":"remove","lines":["\""]}],[{"start":{"row":237,"column":37},"end":{"row":237,"column":42},"action":"insert","lines":["$type"],"id":18}],[{"start":{"row":43,"column":0},"end":{"row":59,"column":5},"action":"remove","lines":["    public function fetchChatusers()","    {","        // here must return logged user full data","        if($this->request->method() == \"POST\")","        {","           $id = Application::$app->session->userId;","","            $this->jData['loggedUserId'] = $id;","            $users = $this->model->fetchChatUsers($id);","              $this->jData['users'] = $users;","           $this->json(); ","","        }else ","        {","        $this->response->renderView(\"/home\" ,$this->data );","        }","    }"],"id":19}],[{"start":{"row":43,"column":0},"end":{"row":59,"column":8},"action":"insert","lines":["    //   public function fetchChatUsers()","    // {","    //     // here must return logged user full data","    //     if($this->request->method() == \"POST\")","    //     {","    //       $id = Application::$app->session->userId;","","    //         $this->jData['loggedUserId'] = $id;","    //         $users = $this->model->fetchChatUsers($id);","    //           $this->jData['users'] = $users;","    //       $this->json(); ","","    //     }else ","    //     {","    //     $this->response->renderView(\"/home\" ,$this->data );","    //     }","    // }"],"id":20}],[{"start":{"row":43,"column":4},"end":{"row":43,"column":7},"action":"remove","lines":["// "],"id":21},{"start":{"row":44,"column":4},"end":{"row":44,"column":7},"action":"remove","lines":["// "]},{"start":{"row":45,"column":4},"end":{"row":45,"column":7},"action":"remove","lines":["// "]},{"start":{"row":46,"column":4},"end":{"row":46,"column":7},"action":"remove","lines":["// "]},{"start":{"row":47,"column":4},"end":{"row":47,"column":7},"action":"remove","lines":["// "]},{"start":{"row":48,"column":4},"end":{"row":48,"column":7},"action":"remove","lines":["// "]},{"start":{"row":50,"column":4},"end":{"row":50,"column":7},"action":"remove","lines":["// "]},{"start":{"row":51,"column":4},"end":{"row":51,"column":7},"action":"remove","lines":["// "]},{"start":{"row":52,"column":4},"end":{"row":52,"column":7},"action":"remove","lines":["// "]},{"start":{"row":53,"column":4},"end":{"row":53,"column":7},"action":"remove","lines":["// "]},{"start":{"row":55,"column":4},"end":{"row":55,"column":7},"action":"remove","lines":["// "]},{"start":{"row":56,"column":4},"end":{"row":56,"column":7},"action":"remove","lines":["// "]},{"start":{"row":57,"column":4},"end":{"row":57,"column":7},"action":"remove","lines":["// "]},{"start":{"row":58,"column":4},"end":{"row":58,"column":7},"action":"remove","lines":["// "]},{"start":{"row":59,"column":4},"end":{"row":59,"column":7},"action":"remove","lines":["// "]}],[{"start":{"row":4,"column":27},"end":{"row":5,"column":0},"action":"insert","lines":["",""],"id":22}],[{"start":{"row":5,"column":0},"end":{"row":5,"column":26},"action":"insert","lines":["use core\\models\\chatModel;"],"id":23}],[{"start":{"row":51,"column":47},"end":{"row":52,"column":0},"action":"insert","lines":["",""],"id":24},{"start":{"row":52,"column":0},"end":{"row":52,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":52,"column":12},"end":{"row":52,"column":58},"action":"insert","lines":[" $notificationModel = new notificationModel();"],"id":25}],[{"start":{"row":52,"column":13},"end":{"row":52,"column":31},"action":"remove","lines":["$notificationModel"],"id":26},{"start":{"row":52,"column":13},"end":{"row":52,"column":22},"action":"insert","lines":["chatModel"]}],[{"start":{"row":52,"column":13},"end":{"row":52,"column":14},"action":"insert","lines":["$"],"id":27}],[{"start":{"row":52,"column":30},"end":{"row":52,"column":47},"action":"remove","lines":["notificationModel"],"id":28},{"start":{"row":52,"column":30},"end":{"row":52,"column":47},"action":"insert","lines":["notificationModel"]}],[{"start":{"row":52,"column":30},"end":{"row":52,"column":47},"action":"remove","lines":["notificationModel"],"id":29},{"start":{"row":52,"column":30},"end":{"row":52,"column":40},"action":"insert","lines":["$chatModel"]}],[{"start":{"row":52,"column":30},"end":{"row":52,"column":31},"action":"remove","lines":["$"],"id":30}],[{"start":{"row":53,"column":21},"end":{"row":53,"column":33},"action":"remove","lines":["$this->model"],"id":31},{"start":{"row":53,"column":21},"end":{"row":53,"column":31},"action":"insert","lines":["$chatModel"]}]]},"ace":{"folds":[],"scrolltop":554,"scrollleft":0,"selection":{"start":{"row":53,"column":53},"end":{"row":53,"column":53},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":93,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1672423112903,"hash":"94b99948aac3f3f819e85fdb54ac7f540eb68636"}