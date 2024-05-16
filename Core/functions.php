<?php
use Core\Response;
use Core\Router;
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
    $_SESSION=[];
    session_destroy();
    $params=session_get_cookie_params();
    setcookie("PHPSESSID","",time()-3600,$params["path"],$params["domain"]);
}