<?php
namespace Http\Forms;
use Http\Forms\LoginForm;
use Core\Validator;
class QuestionForm extends LoginForm{
    public $errors;
    public $attributes;
    public function __construct($attributes){
      $this->attributes=$attributes;
      if(!Validator::string($attributes["title"],7,50)){
          $this->errors["title"]="Can you shorten your title so as to make it more readable?";
      }
      if(!Validator::string($attributes["body"],25,999)){
          $this->errors["body"]="Remember : not too short and not too long";            
      }
      return empty($this->errors);
    } 
}