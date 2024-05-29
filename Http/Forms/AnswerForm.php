<?php
use Http\Forms\LoginForm;
use Core\Validator;
namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;

class AnswerForm{
    public $errors=[];
    public $attributes=[];

    public function __construct($attributes){
      $this->attributes=$attributes;
      if(!Validator::string($attributes["body"],7,250)){
          $this->errors["body"]="Remenber : If you write few words, nobody's gonna understand you";
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