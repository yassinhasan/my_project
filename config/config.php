<?php 
// DIRECTORY_SEPARATOR
!defined("DS") ? define("DS" ,DIRECTORY_SEPARATOR): DS;
// APP_PATH   
!defined("APP_PATH") ? define("APP_PATH" , dirname(__FILE__).DS."..".DS) : APP_PATH;
// APP_VIEW to view folder 
!defined("APP_VIEW") ? define("APP_VIEW" , APP_PATH."core".DS."views".DS) : APP_VIEW;
// APP_LAYOUT_PATH to layout folder 
!defined("APP_LAYOUT_PATH") ? define("APP_LAYOUT_PATH" , APP_VIEW."layout".DS) : APP_LAYOUT_PATH;
// MIGRATIONS_PATH
!defined("MIGRATIONS_PATH") ? define("MIGRATIONS_PATH" , APP_PATH."migrations".DS) : MIGRATIONS_PATH;
// PUBLIC_PATH
!defined("PUBLIC_PATH") ? define("PUBLIC_PATH" , APP_PATH."public".DS) : PUBLIC_PATH;
// UPLOADES_PATH
!defined("UPLOADES_PATH") ? define("UPLOADES_PATH" , PUBLIC_PATH."uploades".DS) : UPLOADES_PATH;
// IMAGES_PATH
!defined("IMAGES_PATH") ? define("IMAGES_PATH" , UPLOADES_PATH."images".DS) : IMAGES_PATH;
// ADMIN
!defined("ADMIN_PATH") ? define("ADMIN_PATH" , IMAGES_PATH."admin".DS) : ADMIN_PATH;
// DASHBOARD
!defined("DASHBOARD_PATH") ? define("DASHBOARD_PATH" , ADMIN_PATH."dashboard".DS) : DASHBOARD_PATH;
// PROFILE_PATH
!defined("PROFILE_PATH") ? define("PROFILE_PATH" , IMAGES_PATH."profile".DS) : PROFILE_PATH;
// CSS_PATH
!defined("CSS_PATH") ? define("CSS_PATH" , "public/css".DS) : CSS_PATH;
// JS_PATH
!defined("JS_PATH") ? define("JS_PATH" , "public/js".DS) : JS_PATH;

defined("FIRSTKEY")  ? FIRSTKEY : define("FIRSTKEY" , "dLnHU+CYIyhpvXoRVcgym+XQGihBcuFfXGiaFQA9bSQ=");
defined("SECONDKEY")  ? SECONDKEY : define("SECONDKEY" , "sSbcYa1tapc1GwtF4IxDeSoyRxk4OguCIn573c3AY3YFnXYI5MopBqpH7Z//cvN3wlasidkiWvg2ZmZBlY7/ZA==");

const PROJECT_NAME = 'smsm_mvc';