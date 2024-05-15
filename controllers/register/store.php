<?php
use Core\App;
$email=$_POST["email"];
$password=$_POST["password"];
$name=$_POST["name"];
$db=App::resolve("Core\Database");
$wasEmailUsed=$db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
    "email"=>$email
])->find();
if($wasEmailUsed){
    header("location: /");
    die();
}else{
    $db->query("INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES (NULL, :name, :email, MD5(:password))",[
        "email"=>$email,
        "password"=>$password,
        "name"=>$name
    ]);
    $_SESSION["user"]=[
        "email"=>$email,
        "password"=>$password,
        "name"=>$name
    ];
    header("location: /");
    die();
}