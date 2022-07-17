<?php
namespace core\controllers;

use core\app\Application;
use core\models\contactModel;

class contactController extends abstractController
{


    public function __construct()
    {
        parent::__construct();
        $this->model = new contactModel;
        $this->data["title"] = "contact";
        $this->data["model"] =  $this->model ;
    }

    public function contact()
    {

        // if request method is get so show page else if show respnse from form 
        if($this->request->method() == "GET")
        {
            $this->response->renderView("contact" ,$this->data );
        }else // here  show respnse from form 
        {
           if ( $this->valid($this->model->rules() , $this->request->getBody()) )
            {

            //  $this->model->getBy();
            
            }
        }


    }

    public function valid($rules , $data)
    {
        if( $this->validate->isValid($this->model , $rules , $data))
        {
           return true;
        }else
        {
         
            $this->data['errors'] =  $this->validate->getErrors();
            $this->response->renderView("contact" , $this->data );
        }
    }



}