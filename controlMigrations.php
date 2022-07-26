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
$config = [
    "db" => 
        [
            "dsn"      => $_ENV['DB_DSN'] , 
            "username" => $_ENV['DB_USERNAME'] ,
            "password" => $_ENV['DB_PASSWORD']
        ]
    ];
$app = new Application($config['db']);

// $app->migrations->dropMirations("m0001_users");
$app->migrations->apllyMigration();
