<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class LoginForm{
    public $errors=[];
    public $attributes=[];

    public function __construct($attributes){
      $this->attributes=$attributes;
      if(!Validator::string($attributes["password"],7,250)){
          $this->errors["password"]="between 7 and 250 must you write password of yours";
      }
      if(!Validator::email($attributes["email"])){
          $this->errors["email"]="between 7 and 250 must you write password of yours";            
      }
      return empty($this->$errors);
    }

    public function throw()
    {
      ValidationException::throw($this->errors,$this->attributes);

    }

    public function failed(){
      return count($this->errors);
    }

    public static function validate($attributes)
    {   
      $instance=new static($attributes);
      return $instance->failed() ? $instance->throw() : $instance;
    }

    public function addError($key,$value){
        $this->errors[$key]=$value;
        return $this;
    }

    public function getErrors(){
        return $this->errors;
    }


}