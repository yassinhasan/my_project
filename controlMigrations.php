<?php
ini_set("display_errors" , 1);
use core\app\Application;
use core\controllers\homecontroller;
use core\controllers\registerController;
use core\controllers\contactController;
require_once "config/config.php";
require_once "vendor/autoload.php";
require_once "config/helper.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// load pusher
 $options = array(
    'cluster' => $_ENV['APP_CLUSTER'],
    'useTLS' => true
  );
//   $pusher = new Pusher\Pusher(
//     $_ENV['APP_KEY'],
//     $_ENV['APP_SECRET'],
//     $_ENV['APP_ID'],
//     $options
//   );


//end pusher 

$config = [
    "database" => 
        [
            "dsn"      => $_ENV['DB_DSN'] , 
            "username" => $_ENV['DB_USERNAME'] ,
            "password" => $_ENV['DB_PASSWORD']
        ] ,
        "smtp"=>
        [
            "email" => $_ENV['SMTP_EMAIL'] ,
            "password" => $_ENV['SMTP_PASSWORD'] ,
        ] , 
        "pusher" =>
        [
            new Pusher\Pusher(
            $_ENV['APP_KEY'],
            $_ENV['APP_SECRET'],
            $_ENV['APP_ID'],
            $options
          )
        ]
        
    ];
$app = new Application($config);

// $app->migrations->dropMirations("m0001_users");
$app->migrations->apllyMigration();
