<?php
use Core\App;
$email=$_POST["email"];
$password=$_POST["password"];
$name=$_POST["name"];
$db=App::resolve("Core\Database");
$wasEmailUsed=$db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
    "email"=>$email
])->find();
if($wasEmailUsed  ){
    redirect("/");
}else{
    $db->query("INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (NULL, :name, :email, :password)",[
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
}