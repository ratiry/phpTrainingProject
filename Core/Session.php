<?php
namespace Core;
class Session{
    public function has($key)
    {
        return (bool) static::get($key);
    }
    public static function put($key,$value)
    {
        $_SESSION[$key]=$value;
    }
    public static function get($key,$default=NULL)
    {
        if(isset($_SESSION["_temp"][$key])){
            return $_SESSION["_temp"][$key] ?? $default;
        }
        return $_SESSION[$key] ?? $default;
    }
    public static function addTemp($key,$value)
    {
        $_SESSION["_temp"][$key]=$value;
    }
    public static function destroyTemp()
    {
       unset( $_SESSION["_temp"]);
    }
    public static function flush()
    {
        $_SESSION=[];
    }
    public static function destroy()
    {
        static::flush();
        session_destroy();
        $params=session_get_cookie_params();
        setcookie("PHPSESSID","",time()-3600,$params["path"],$params["domain"]);
    }
}