<?php
namespace Core;
use Core\App;
class Authenticator{
    public function attempt($email,$password)
    {
        $db=App::resolve("Core\Database");
        $user= $db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
            "email"=>$_POST["email"]
        ])->find();
        if(password_verify($_POST["password"],$user["password"]) && $user){
            $this->login($user);
            return true;
        }
        return false;
    }
    public function login($user)
    {
        $_SESSION["user"]=$user;
        session_regenerate_id(true);
    }
    public function logout()
    {
        $_SESSION=[];
        session_destroy();
        $params=session_get_cookie_params();
        setcookie("PHPSESSID","",time()-3600,$params["path"],$params["domain"]);
    }
}