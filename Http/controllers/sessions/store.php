<?php
use Http\Forms\LoginForm;
use Core\Authenticator;

$form=LoginForm::validate([
  "email"=>$_POST["email"],
  "password"=>$_POST["password"]
]);



$auth=new Authenticator();
$singedIn= $auth->attempt($_POST["email"],$_POST["password"]);

if(!$singedIn){
  $form->addError("login","If you're a person who misprinted/forgot their password/email , try again! "."<br>"."If you're a hacker or a bot,  there's nothing to hack for you :(")
  ->throw();
} 
return redirect("/");





