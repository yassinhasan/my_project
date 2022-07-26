#!/usr/bin/bash
echo "Please Enter File Name"
read -p "File Name is : " filename
ROOT_PATH=`pwd`
CONTROOLERS_PATH=$ROOT_PATH"/core/controllers/"
MODELS_PATH=$ROOT_PATH"/core/models/"
CSS_PATH=$ROOT_PATH"/public/css/"
JS_PATH=$ROOT_PATH"/public/js/"
VIEW_PATH="/core/views/"

Model_text='
<?php
namespace core\models;
use core\app\Rrequest;
use core\app\Validate;
use core\models\abstractModel;
class changeModel extends abstractModel
{
    public function rules()
    {
        return [

        ];

    }
}
'

Controller_text='
<?php
namespace core\controllers;

use core\app\Application;

class changecontroller extends abstractController
{


    public function change()
    {

        $data = [
            "title" => "change"
        ];
        $data['links'] = [
            "css" => ["change"] ,
            "js" => [
                "change" ,

            ]
        ];
        $this->response->renderView("/change" ,$data );
    }
}
'

if [[ -n $filename ]]; then
    #statements
    CONTROOLERS_FILE=$CONTROOLERS_PATH$filename"Controller.php"
    MODELS_FILE=$MODELS_PATH$filename"Model.php"
    CSS_FILE=$CSS_PATH$filename".css"
    JS_FILE=$JS_PATH$filename".js"
    VIEW_FILE=$VIEW_PATH$filename".php"
    else
    echo "Sorry You Must Enter File Name"
fi

if [[ -e $CONTROOLERS_FILE || -e $MODELS_FILE || -e $CSS_FILE || -e $JS_FILE ]]; then
        #statements
        echo "Sorry This Files Files Found Before"
        else
        # here creating files
        echo "Creating Files .... !"
        `echo sleep 2`
        Controller_result=$(echo $Controller_text | sed "s/change/$filename/g")
        Model_result=$(echo $Model_text | sed "s/change/$filename/g")
        echo  $Controller_result > $CONTROOLERS_FILE
        echo  $Model_result > $MODELS_FILE
        `touch $CSS_FILE `
        `touch $JS_FILE`
        `touch $VIEW_FILE`
        
fi