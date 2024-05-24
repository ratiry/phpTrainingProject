<?php
namespace Core\Middleware;
class Middleware{
    const  MAP=[
        "guest"=>Guest::class,
        "auth"=>Auth::class,
    ];
    public static function resolve($route)
    {
        if($route["middleware"]!=NULL){
            $middleware= static::MAP[$route["middleware"]];
            if($middleware!=NULL){
                $middleware::handle($route);
            }else{
                throw new \Exception("DK how  to apply this middleware ".$route["middleware"]);
            }
        }        
    }
};