// <?php
// namespace core\app;
// class Pusher
// {

//     private  $config= [];
//     public $pusher;
//     public function __construct($config)
//     {
//         $this->config = $config;
        
//     }
//     public function getPusher()
//     {

//       $options = array(
//         'cluster' => $this->config['app_cluster'],
//         'useTLS' => true
//       );
//      return  $pusher = new Pusher\Pusher(
//         $this->config['APP_KEY'],
//         $this->config['APP_SECRET'],
//         $this->config['APP_ID'],
//         $options
//       );
//     }

// }
// ?>