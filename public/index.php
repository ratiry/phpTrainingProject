<?php
session_start();
use Core\Router;
use Core\Session;
use Core\ValidationException;
const BASE_PATH = __DIR__.'/../';
require BASE_PATH."/vendor/autoload.php";
require BASE_PATH.'Core/functions.php';
require base_path("bootstrap.php");

$router=new Router();
$routes = require base_path("routes.php");
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method="";

if(isset( $_POST["_method"])){
  $method=$_POST["_method"];
}else{
  $method=$_SERVER["REQUEST_METHOD"];
}
try{
  $router->route($uri, $method);
}catch(ValidationException $exception){
  Session::addTemp("errors",$exception->errors);
  
  Session::addTemp("old",[
    "email"=>$_POST["email"]
  ]);
  return redirect($router->previousUrl());
}

Session::destroyTemp(); 

