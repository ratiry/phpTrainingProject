<?php
use Core\Response;
use Core\Router;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN)
{   $router=new Router;
    if ( $condition) {
      $router->abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}
function login($user){
    $_SESSION["user"]=$user;
    session_regenerate_id(true);
}
function logout(){
    Session::destroy();
}
function redirect($path){
    header("location: ".$path);
    die();      
}
function old($key,$default=""){
  return Session::get("old")[$key] ?? $default;
}