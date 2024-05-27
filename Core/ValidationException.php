<?php
namespace Core;

class ValidationException extends \Exception{
public $errors=[];
public $old=[];
 public static function throw($errors,$old)
 {
    $instance=new static;
    $instance->old["email"]=$old["email"];
    $instance->old["title"]=$old["title"];
    $indtance->old["body"]=$old["body"];
    $instance->old["password"]=$old["password"];
    $instance->errors=$errors;
    throw $instance;
 }
}