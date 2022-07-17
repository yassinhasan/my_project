<?php
ini_set("display_errors" , 1);
use core\app\Application;
use core\controllers\accessController;
use core\controllers\homecontroller;
use core\controllers\registerController;
use core\controllers\loginController;
use core\controllers\logoutController;
use core\controllers\contactController;
use core\controllers\admin\dashBoardController;
use core\controllers\forgetPasswordController;
use core\controllers\notfoundController;
use core\controllers\profileController;
use core\controllers\resetPasswordController;


require_once "config/config.php";
require_once "vendor/autoload.php";
require_once "config/helper.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ , '.env');
$dotenv->load();
$config = [
    "db" => 
        [
            "dsn"      => $_ENV['DB_DSN'] , 
            "username" => $_ENV['DB_USERNAME'] ,
            "password" => $_ENV['DB_PASSWORD']
        ] ,
        "smtp"=>
        [
            "email" => $_ENV['SMTP_EMAIL'] ,
            "password" => $_ENV['SMTP_PASSWORD'] ,
        ]
        
    ];
  
   
$app = new Application($config['db']);
$app->router->get("/",[ homecontroller::class , "home"]);
$app->router->get("/notfound",[ notfoundController::class , "notfound"]);
$app->router->get("/home",[ homecontroller::class , "home"]);
$app->router->get("/register",[ registerController::class , "register"]);
$app->router->post("/register",[ registerController::class , "register"]);
$app->router->get("/login",[ loginController::class , "login"]);
$app->router->get("/logout",[ logoutController::class , "logout"]);
$app->router->post("/login",[ loginController::class , "login"]);
$app->router->get("/contact",[ contactController::class , "contact"]);
$app->router->post("/contact",[ contactController::class , "contact"]);
$app->router->get("/profile",[ profileController::class , "profile"]);
$app->router->post("/profile/saveProfile",[ profileController::class , "saveProfile"]);
$app->router->post("/profile/updateProfileImage",[ profileController::class , "updateProfileImage"]);
$app->router->get("/forgetPassword",[ forgetPasswordController::class ,  "forgetPassword"]);
$app->router->post("/forgetPassword",[ forgetPasswordController::class ,  "forgetPassword"]);
$app->router->get("/resetPassword",[ resetPasswordController::class ,  "resetPassword"]);
$app->router->post("/resetPassword",[ resetPasswordController::class ,  "resetPassword"]);

// admin 
$app->router->get("/dashboard",[ dashBoardController::class ,  "dashboard"]);

$app->run();