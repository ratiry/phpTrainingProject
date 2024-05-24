<?php
session_start();
use Core\Router;
use Core\Session;
const BASE_PATH = __DIR__.'/../';

spl_autoload_register(function ($class) {
    $class=str_replace("\\","/",$class);
    require base_path($class . '.php');
});
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
$router->route($uri, $method);

Session::deleteFlash();

