{"filter":false,"title":"TestController.php","tooltip":"/core/controllers/TestController.php","undoManager":{"mark":27,"position":27,"stack":[[{"start":{"row":8,"column":6},"end":{"row":8,"column":21},"action":"remove","lines":["loginController"],"id":2},{"start":{"row":8,"column":6},"end":{"row":8,"column":20},"action":"insert","lines":["TestController"]}],[{"start":{"row":16,"column":0},"end":{"row":21,"column":10},"action":"remove","lines":["        $this->data[\"title\"] = \"login\";","        $this->data['model'] = $this->model;","        $this->data['links'] = [","            \"css\" => [\"login\"] ,","            \"js\" => [\"login\" ]","        ];"],"id":3},{"start":{"row":15,"column":38},"end":{"row":16,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":22,"column":0},"end":{"row":85,"column":13},"action":"remove","lines":["        $isLogged = authenticateController::isLogged();","        if($isLogged)","        {","            $this->response->redirect(\"/\");","        }","        // if request method is get so show page else if show respnse from form ","        if($this->request->method() == \"POST\")","        {","            $rules = $this->model->rules() ;","            $data = $this->request->getBody();","            if ( $this->validate->isValid( $this->model , $rules , $data) )","            {","              ","                $user = $this->model->findUser();","                if ($user) ","                {","                    $rememberMe = isset($data[\"rememberMe\"]) ?? null ;","                    $password =  $data['password'];","                    $hashedUsername = $this->encrypt($user->firstName.$user->lastName);","                    if(password_verify($password , $user->password ))","                    {","                        if($rememberMe and $rememberMe ==\"yes\")","                        {","                            ","                            $this->cookie->setCookie(\"loginCode\" ,  $hashedUsername);","                        }else","                        {","                              $this->session->loginCode =  $hashedUsername;                        ","                        }","                        $this->session->userId = $user->id;","                        if($user->isAdmin == 1)","                        {","                            $this->jData['success_admin'] = \"you have login succuflly\";","                        }else","                        {","                          $this->jData['success'] = \"you have login succuflly\";  ","                          $this->model->updateLoginStatus($user->id);","                        }","                         $this->session->setFlashMsg(\"success_login\" , \" you have login succuflly\");","                        ","                         $Pusherdata[\"userId\"] = $user->id;","                         $Pusherdata[\"onlineStatus\"] = STATUS_ONLINE;","                         $this->pusher->trigger( $_ENV['CHANNEL'], 'isLogged',  $Pusherdata);","                        ","                    }else","                    {","                        $this->validate->addCustomError(\"password\" , \"sorry this Password is not matched\");","                        $this->jData['errors'] =  $this->validate->getErrors();","                      ","                    }","                }else","                {","                    $this->validate->addCustomError(\"email\" , \"sorry this Email does not exists\");","                    $this->jData['errors'] =  $this->validate->getErrors();","                }","               ","                ","                ","            }else","            {","                $this->jData['errors'] =  $this->validate->getErrors();","                ","             ","            }"],"id":4}],[{"start":{"row":25,"column":0},"end":{"row":29,"column":9},"action":"remove","lines":["           ","        }else","        {","            $this->response->renderView(\"login\" ,$this->data );","        }"],"id":5}],[{"start":{"row":25,"column":0},"end":{"row":28,"column":0},"action":"remove","lines":["","    ","",""],"id":6}],[{"start":{"row":23,"column":0},"end":{"row":23,"column":8},"action":"remove","lines":["        "],"id":7},{"start":{"row":22,"column":0},"end":{"row":23,"column":0},"action":"remove","lines":["",""]},{"start":{"row":21,"column":5},"end":{"row":22,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":22,"column":26},"end":{"row":23,"column":0},"action":"remove","lines":["",""],"id":8}],[{"start":{"row":20,"column":20},"end":{"row":20,"column":25},"action":"remove","lines":["login"],"id":9},{"start":{"row":20,"column":20},"end":{"row":20,"column":21},"action":"insert","lines":["t"]},{"start":{"row":20,"column":21},"end":{"row":20,"column":22},"action":"insert","lines":["e"]},{"start":{"row":20,"column":22},"end":{"row":20,"column":23},"action":"insert","lines":["s"]},{"start":{"row":20,"column":23},"end":{"row":20,"column":24},"action":"insert","lines":["t"]},{"start":{"row":20,"column":24},"end":{"row":20,"column":25},"action":"insert","lines":["1"]}],[{"start":{"row":21,"column":5},"end":{"row":22,"column":0},"action":"insert","lines":["",""],"id":10},{"start":{"row":22,"column":0},"end":{"row":22,"column":8},"action":"insert","lines":["        "]},{"start":{"row":22,"column":8},"end":{"row":22,"column":9},"action":"insert","lines":["$"]},{"start":{"row":22,"column":9},"end":{"row":22,"column":10},"action":"insert","lines":["t"]}],[{"start":{"row":22,"column":8},"end":{"row":22,"column":10},"action":"remove","lines":["$t"],"id":11},{"start":{"row":22,"column":8},"end":{"row":22,"column":13},"action":"insert","lines":["$this"]}],[{"start":{"row":22,"column":13},"end":{"row":22,"column":14},"action":"insert","lines":["-"],"id":12},{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"insert","lines":["."]}],[{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"remove","lines":["."],"id":13}],[{"start":{"row":22,"column":14},"end":{"row":22,"column":15},"action":"insert","lines":[">"],"id":14},{"start":{"row":22,"column":15},"end":{"row":22,"column":16},"action":"insert","lines":["j"]}],[{"start":{"row":22,"column":15},"end":{"row":22,"column":16},"action":"remove","lines":["j"],"id":15},{"start":{"row":22,"column":15},"end":{"row":22,"column":20},"action":"insert","lines":["jData"]}],[{"start":{"row":22,"column":20},"end":{"row":22,"column":22},"action":"insert","lines":["[]"],"id":16}],[{"start":{"row":22,"column":21},"end":{"row":22,"column":23},"action":"insert","lines":["\"\""],"id":17}],[{"start":{"row":22,"column":22},"end":{"row":22,"column":23},"action":"insert","lines":["t"],"id":18},{"start":{"row":22,"column":23},"end":{"row":22,"column":24},"action":"insert","lines":["e"]},{"start":{"row":22,"column":24},"end":{"row":22,"column":25},"action":"insert","lines":["s"]},{"start":{"row":22,"column":25},"end":{"row":22,"column":26},"action":"insert","lines":["t"]}],[{"start":{"row":22,"column":27},"end":{"row":22,"column":28},"action":"insert","lines":["="],"id":19}],[{"start":{"row":22,"column":27},"end":{"row":22,"column":28},"action":"remove","lines":["="],"id":20}],[{"start":{"row":22,"column":27},"end":{"row":22,"column":28},"action":"insert","lines":["="],"id":21}],[{"start":{"row":22,"column":27},"end":{"row":22,"column":28},"action":"remove","lines":["="],"id":22}],[{"start":{"row":22,"column":28},"end":{"row":22,"column":29},"action":"insert","lines":[" "],"id":23},{"start":{"row":22,"column":29},"end":{"row":22,"column":30},"action":"insert","lines":["="]}],[{"start":{"row":22,"column":30},"end":{"row":22,"column":31},"action":"insert","lines":[" "],"id":24}],[{"start":{"row":22,"column":31},"end":{"row":22,"column":33},"action":"insert","lines":["\"\""],"id":25}],[{"start":{"row":22,"column":32},"end":{"row":22,"column":33},"action":"insert","lines":["h"],"id":26},{"start":{"row":22,"column":33},"end":{"row":22,"column":34},"action":"insert","lines":["a"]},{"start":{"row":22,"column":34},"end":{"row":22,"column":35},"action":"insert","lines":["s"]},{"start":{"row":22,"column":35},"end":{"row":22,"column":36},"action":"insert","lines":["a"]},{"start":{"row":22,"column":36},"end":{"row":22,"column":37},"action":"insert","lines":["n"]}],[{"start":{"row":22,"column":38},"end":{"row":22,"column":39},"action":"insert","lines":[";"],"id":27}],[{"start":{"row":20,"column":20},"end":{"row":20,"column":25},"action":"remove","lines":["test1"],"id":28},{"start":{"row":20,"column":20},"end":{"row":20,"column":24},"action":"insert","lines":["Test"]}],[{"start":{"row":20,"column":20},"end":{"row":20,"column":24},"action":"remove","lines":["Test"],"id":29},{"start":{"row":20,"column":20},"end":{"row":20,"column":24},"action":"insert","lines":["test"]}]]},"ace":{"folds":[],"scrolltop":240,"scrollleft":0,"selection":{"start":{"row":20,"column":24},"end":{"row":20,"column":24},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":9,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1664285762382,"hash":"8153f14755ae41e8e23d6e7de6727de86db10546"}