{"filter":false,"title":"loginController.php","tooltip":"/core/controllers/loginController.php","undoManager":{"mark":1,"position":1,"stack":[[{"start":{"row":66,"column":0},"end":{"row":69,"column":94},"action":"remove","lines":["                         $Pusherdata[\"userId\"] = $this->session->userId;","                         $Pusherdata[\"onlineStatus\"] = STATUS_ONLINE;","                        //  $this->pusher->socket_auth($_POST[\"channel_name\"],  $socket_id);","                          $this->pusher->trigger( $_ENV['CHANNEL'], 'isLogged',  $Pusherdata);"],"id":378},{"start":{"row":65,"column":25},"end":{"row":66,"column":0},"action":"remove","lines":["",""]}],[{"start":{"row":63,"column":0},"end":{"row":64,"column":0},"action":"insert","lines":["                          $this->model->updateLoginStatus($user->id);",""],"id":379,"ignore":true},{"start":{"row":65,"column":26},"end":{"row":65,"column":69},"action":"remove","lines":["$this->model->updateLoginStatus($user->id);"]}]]},"ace":{"folds":[],"scrolltop":1162.5,"scrollleft":103,"selection":{"start":{"row":63,"column":40},"end":{"row":63,"column":57},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":47,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1667170665524,"hash":"9e7e06181e94cf52cbf37076d312ad4b94cf59f9"}