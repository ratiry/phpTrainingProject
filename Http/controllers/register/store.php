<?php
use Core\App;
use Core\Validator;
use Core\Session;
$email=$_POST["email"];
$password=$_POST["password"];
$name=$_POST["name"];
$db=App::resolve("Core\Database");
$wasEmailUsed=$db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
    "email"=>$email
])->find();
if(!Validator::string($password,7,255)){
  Session::addTemp("password","between 7 and 255 must you password write");
  redirect("/register");
}
if($wasEmailUsed){
    redirect("/");
}
$db->query("INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES (NULL, :email, :name, :password);",[
    "email"=>$email,
    "password"=>password_hash( $password,PASSWORD_BCRYPT),
    "name"=>$name
]);
login([
    "email"=>$email,
    "password"=>$password,
    "name"=>$name
]);
redirect("/");
