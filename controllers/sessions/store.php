<?php
use Core\App;
$db=App::resolve("Core\Database");
$errors=[];
$user= $db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
    "email"=>$_POST["email"]
])->find();
if(password_verify($_POST["password"],$user["password"]) && $user){
    login($user);
    header("location: /");
    die();
}else{
    $errors["login"]=" If you're a person who misprinted their password/email , try again! "."<br>"."If you're a hacker or a bot,  there's nothing to hack for you :(";
    view("sessions/create.view.php",[
        "errors"=>$errors
    ]);
};

