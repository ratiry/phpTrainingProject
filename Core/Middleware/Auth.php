<?php
namespace Core\Middleware;
class Auth{
    public static function handle($route)
    {
        if($route["middleware"]=="auth" && $_SESSION["user"]==false){
            header("location: /");
            die();           
        }
    }
}