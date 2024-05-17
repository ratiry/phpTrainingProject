<?php
use Core\App;
use Http\Forms\LoginForm;
$db=App::resolve("Core\Database");
$user= $db->query("SELECT * FROM `users` WHERE `email` LIKE :email",[
    "email"=>$_POST["email"]
])->find();
$form=new LoginForm;
$form->validate($_POST["email"],$_POST["password"]);
if(!empty($form->errors)){
    view("sessions/create.view.php",[
        "errors"=>$form->errors
    ]);
    die();
}
if(password_verify($_POST["password"],$user["password"]) && $user){
    login($user);
    header("location: /");
    die();
}
$errors["login"]=" If you're a person who misprinted their password/email , try again! "."<br>"."If you're a hacker or a bot,  there's nothing to hack for you :(";
view("sessions/create.view.php",[
    "errors"=>$errors
]);