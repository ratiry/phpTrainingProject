<?php
namespace Core;

class ValidationException extends \Exception{
public $errors=[];
public $old=[];
 public static function throw($errors,$old)
 {
    $instance=new static;
    $instance->old["email"]=$old["email"];
    $instance->old["password"]=$old["password"];
    $instance->errors=$errors;
    throw $instance;
 }
}