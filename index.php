<?php
ini_set("display_errors" , 1);
date_default_timezone_set("Asia/Riyadh");
use core\app\Application;
use core\controllers\accessController;
use core\controllers\homecontroller; 
use core\controllers\notificationController;
use core\controllers\userPostsController;
use core\controllers\showPostController;
use core\controllers\registerController;
use core\controllers\loginController;
use core\controllers\logoutController;
use core\controllers\contactController;
use core\controllers\admin\dashBoardController;
use core\controllers\forgetPasswordController;
use core\controllers\notfoundController;
use core\controllers\profileController;
use core\controllers\resetPasswordController;
use core\controllers\chatController;

require_once "config/config.php";
require_once "vendor/autoload.php";
require_once "config/helper.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ , '.env');
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
$app->router->get("/",[ homecontroller::class , "home"]);
$app->router->post("/",[ homecontroller::class , "home"]);
$app->router->get("/notfound",[ notfoundController::class , "notfound"]);
$app->router->get("/home",[ homecontroller::class , "home"]);
$app->router->post("/sharePosts",[ homecontroller::class , "sharePosts"]);
$app->router->post("/postDelete",[ homecontroller::class , "postDelete"]);
$app->router->post("/postEdit",[ homecontroller::class , "postEdit"]);
$app->router->post("/fetchPosts",[ homecontroller::class , "fetchPosts"]);
$app->router->post("/fetchUsers",[ homecontroller::class , "fetchUsers"]);
$app->router->post("/addComment",[ homecontroller::class , "addComment"]);
$app->router->post("/deleteComment",[ homecontroller::class , "deleteComment"]);
$app->router->post("/updateComment",[ homecontroller::class , "updateComment"]);
$app->router->post("/addLike",[ homecontroller::class , "addLike"]);
$app->router->post("/fetchLikes",[ homecontroller::class , "fetchLikes"]);
$app->router->post("/fetchComments",[ homecontroller::class , "fetchComments"]);
$app->router->post("/presenceAuth",[ homecontroller::class , "presenceAuth"]);
$app->router->post("/getNotifications",[ homecontroller::class , "getNotifications"]);
$app->router->post("/updateNotification",[ homecontroller::class , "updateNotification"]);


$app->router->post("/fetchChatusers",[ homecontroller::class , "fetchChatusers"]);

$app->router->post("/updateLastActivity",[ homecontroller::class , "updateLastActivity"]);
$app->router->post("/updateLastActivityById",[ homecontroller::class , "updateLastActivityById"]);
$app->router->post("/updateLastStatusById",[ homecontroller::class , "updateLastStatusById"]);

$app->router->post("/fetchUpdateUserFollowSystem",[ homecontroller::class , "fetchUpdateUserFollowSystem"]);
//  userPotsts
$app->router->get("/userPosts",[ userPostsController::class , "userPosts"]);
$app->router->get("/showPost",[ showPostController::class , "showPost"]);
$app->router->post("/fetchPostsById",[ userPostsController::class , "fetchPostsById"]);

// chat
$app->router->post("/chat/loadChat",[ chatController::class , "loadChat"]); 
$app->router->post("/chat/addMsg",[ chatController::class , "addMsg"]);
$app->router->post("/chat/fetchPrivateChat",[ chatController::class , "fetchPrivateChat"]);
$app->router->post("/chat/blurEvent",[ chatController::class , "blurEvent"]);
// $app->router->post("/chat/fetchChatUsers",[ chatController::class , "fetchChatUsers"]);
$app->router->post("/chat/blur",[ chatController::class , "blur"]); 
// $app->router->get("/chat",[ chatController::class , "chat"]);
//test
$app->router->get("/register",[ registerController::class , "register"]);
$app->router->post("/register",[ registerController::class , "register"]);
$app->router->get("/login",[ loginController::class , "login"]);
$app->router->get("/logout",[ logoutController::class , "logout"]);
$app->router->post("/login",[ loginController::class , "login"]);

// load notifications
$app->router->get("/contact",[ contactController::class , "contact"]);
$app->router->post("/contact",[ contactController::class , "contact"]);
$app->router->get("/profile",[ profileController::class , "profile"]);
$app->router->post("/profile/saveProfile",[ profileController::class , "saveProfile"]);
$app->router->post("/profile/updateProfileImage",[ profileController::class , "updateProfileImage"]);
$app->router->get("/forgetPassword",[ forgetPasswordController::class ,  "forgetPassword"]);
$app->router->post("/forgetPassword",[ forgetPasswordController::class ,  "forgetPassword"]);
// $app->router->get("/resetPassword",[ resetPasswordController::class ,  "resetPassword"]);
$app->router->post("/resetPassword",[ resetPasswordController::class ,  "resetPassword"]);

// admin 
$app->router->get("/dashboard",[ dashBoardController::class ,  "dashboard"]);

$app->run();
   

 
