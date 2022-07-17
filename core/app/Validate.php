<?php 
namespace core\app;
class Validate extends abstractValidate
{
    public function getErrors()
    {
        $errors = [];
        foreach($this->error as $key=>$value)
        {
            $errors[$key] =$this->error[$key][0] ;
            
        }
        return $errors;
    }
    
    public function isValid($model , $allRules , $data)
    {
        
        foreach($allRules as $field=>$rules)
        {
            $filed_name = $field;
            $filed_value =  $data[$filed_name];
           $model->{$filed_name} = $filed_value;
            foreach($rules as $rule)
            {
               
                if(is_array($rule))
                {
                   
                   foreach($rule as $key => $macted)
                   {
                       
                       
                       $this->$key($filed_name , $filed_value , $macted);
                   }
                }else
                {  
                    $this->$rule($filed_name , $filed_value );
                }
                
              
            }   

        }
        return empty($this->error);
    }

    public function printClass($filed_name)
    {
               
        return $this->hasError($filed_name) ? "is-invalid" : '';

  
    }
    public function printُُُErrorMessage($filed_name)
    {

        $errorMessage = $this->getFirstError($filed_name);
        return $this->hasError($filed_name) ?  "<div class='invalid-feedback'>$errorMessage</div>" : '';
    }

    public function getFirstError($filed_name)
    {
      
       return $this->hasError($filed_name) ? $this->error[$filed_name][0] : false;

    }
    
    public function hasError($filed_name)
    {
        
       if(!empty($this->getErrors()))
       {
          
        return array_key_exists($filed_name , $this->getErrors()) ;
       }

    }

    public function addCustomError($field , $message)
    {
        $this->error[$field][] = $message; 
    }
}