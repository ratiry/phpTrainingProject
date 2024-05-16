<?php
namespace Core\Middleware;
class Guest{
     public static function handle($route)
    {
        if($route["middleware"]=="guest" && $_SESSION["user"]!=false){
            header("location: /");
            die();           
        }
    }
}