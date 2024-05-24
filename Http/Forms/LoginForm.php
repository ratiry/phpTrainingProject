<?php

namespace Http\Forms;
use Core\Validator;
class LoginForm{
    protected $errors=[];
    public function validate($email,$password)
    {   
        if(!Validator::string($password,7,250)){
            $this->errors["password"]="between 7 and 250 must you write password of yours";
        }
        if(!Validator::email($email)){
            $this->errors["email"]="between 7 and 250 must you write password of yours";            
        }
        return empty($this->$errors);
    }
    public function addError($key,$value){
        $this->errors[$key]=$value;
    }
    public function getErrors(){
        return $this->errors;
    }
}