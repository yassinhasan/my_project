<?php 
namespace core\app;
class View 
{
    public $model = null;
    public function __construct()
    {
        $this->validate = Application::$app->validate;
    }

    public function startPostForm($model , $url = '')
    {
        $this->model = $model;
        echo "<form method='POST' action='".$url."' class='form'> ";
    }
    public function startFileForm($model , $url = '' , $class)
    {
        $this->model = $model;
        echo "<form method='POST' action='".$url."' class='$class' enctype='multipart/form-data'>";
    }
    public function renderInput( $names = [] , $type , $col = "")
    {

        foreach($names as $name=>$label)
        {
            $value = ($this->model->$name) == null ? '' : $this->model->$name;
            $class = $this->validate->printClass($name);
            echo " <div class='mb-3 $col'>";
            echo       "<label for='$name' class='form-label'>$label </label>
            <input type='$type' class='form-control $class' id='$name'  name='$name' value='$value'>
            ";
           echo  $this->validate->printُُُErrorMessage($name) ; 
            echo "</div>";
        }

    }

    public function renderSubmitBtn(array $data = [
        "name" => "save" , 
        "class" => "primary" ,
        "data" => "" ,
        "label" => "submit"
    ])
    {
            echo "<button type='submit' class='btn btn-".$data['class']."' name='".$data['name']."' ".$data['data'].">".$data['label']."</button>";
    }
    public function renderCheckBtn($name , $value ='' , $label = "")
    {
            echo "<div class='form-check'>
            <input class='form-check-input' type='checkbox'  id='flexCheckDefault' name ='$name' value='$value'>
            <label class='form-check-label' for='flexCheckDefault'>
            $label
            </label>
        </div>";

    }
    public function endForm()
    {
        echo "</form>";
    }

    public function getFlashMsg($key , $type )
    {
        if(Application::$app->session->hasFlashMsg($key) ) 
        {
           
           $msg = Application::$app->session->pull($key);
            echo  "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
            <strong>$type</strong> $msg
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
        }else
        {
            return null;
        }
    }
}