<?php
namespace core\app;
class abstractValidate 
{
    public $request;
    protected $error = [];
    const FIELD__REQUIRED = "required"; 
    const FIELD__NAME = "name"; 
    const FIELD__PASSWORD= "password";
    const FIELD__EMAIL = "email";
    const FIELD__MIN = "min";
    const FIELD__MAX = "max";
    const FIELD__MATCHED = "matched";
    const FIELD__UNIQUE = "unique";
    const FIELD__UNIQUE_IN_OHER = "unique_in_other";
    const FIELD__EQUAL = "equal";
    const FIELD__INT = "isInt";
    const CUSTOME_MSG = null;
   public function __construct()
   {
       
       $this->request = Application::$app->request;
   }
   

   public function required($field , $value )
   {
       
      if($value == "")
        $this->error[$field][] = "Sorry This ".ucfirst($field)." Can Not Be Empty";

     
   }
   public function email($field , $value)
   {
        if($value != null or $value != "") 
        {
            if(! filter_var($value,FILTER_VALIDATE_EMAIL))
        $this->error[$field][] = "sorry ".ucfirst($field)."is not valid email"; 
        }

   }
   
  public function name($field , $value , $message =null)
  {
        if($value != null or $value != "") 
        {
           $rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#0-9_-]+/i";
            if(preg_match($rexSafety , $value) == true)
            $this->error[$field][] =  "Sorry This ".ucfirst($field)." Is Must be String";
        };

  }
public function password($field , $value , $message =null)
   {
        if($value != null or $value != "") 
        {
            $uppercase  = preg_match("@[A-Z]@" , $value);
            $lowercase = preg_match("@[a-z]@" , $value);
            $number = preg_match("@[0-9]@" , $value);
            if(!$uppercase || !$lowercase || !$number ) 
            {
                 $this->error[$field][] =  "Sorry This ".ucfirst($field)." Not Matched";
            };
        }



   }

   public function isInt($field , $value)
   {
       
       if($value != null or $value !== "")
       {
            if(! filter_var((int)$value,FILTER_VALIDATE_INT))
            $this->error[$field][] = "sorry ".ucfirst($field)." is not valid number";
       }

   }
   public function min($field , $value , $matched)
   {
        if($value != null or $value != "") 
        {
            if(strlen($value) < $matched )
            {
                $this->error[$field][] = "sorry ".ucfirst($field)." is must be less than $matched";
            }
        }

     
   }
   public function max($field , $value , $matched)
   {
        if($value != null or $value != "") 
        {
            if(strlen($value) > $matched )
            {
                $this->error[$field][] = "sorry ".ucfirst($field)." is must be more than $matched";
            }
        }

     
   }
   public function equal($field , $value , $matched)
   {
       if($value != null or $value != "") 
       {
            if(strlen($value) != $matched )
            {
                $this->error[$field][] = "sorry".ucfirst($field)." is must be equal $matched";
            }
       }

     
   }
   public function matched($field , $value , $matched)
   {
   
       $matchedValue = $this->request->getBody()[$matched];
       if($value !== $matchedValue )
       {
           $this->error[$field][] = "sorry ".ucfirst($field)." is must be equal to  $matched";
       }
     
   }
   public function unique_in_other($field , $value , $matched)
   {
       //[Validate::FIELD__UNIQUE_IN_OHER =>["app_users", "email" , "userId" , $id] ]

       // $matched = "app_users", "email" , "userId" , $id
     
       list($table,$selected , $matchedTo , $matched_value) = $matched ;
       $sql = " SELECT $selected FROM $table WHERE $matchedTo !=  :id AND $selected = :value ";

       $stmt = Application::$app->db->pdo->prepare($sql);   
       $stmt->execute(array(
           ":id" => $matched_value , 
           ":value" => $value
       ));
       $findUser = $stmt->fetchAll(\PDO::FETCH_CLASS);
       if($findUser)
       {
           $this->error[$field][] = "sorry this ".ucfirst( $field) ." is taken by others "; 
       }
     
   }
   public function unique($field , $value , $matched)
   {
   
       $table = $matched[0];
       $matched = $matched[1];
       $sql = " SELECT $field FROM $table WHERE $field =  ?  ";
       $stmt = Application::$app->db->pdo->prepare($sql);
       $stmt->bindValue(1 , $value , \PDO::PARAM_STR);
       $stmt->execute();
       $findUser = $stmt->fetchAll(\PDO::FETCH_CLASS);
       if($findUser)
       {
           $this->error[$field][] = "sorry this ".ucfirst( $field) ." is exists before "; 
       }
     
   }
}