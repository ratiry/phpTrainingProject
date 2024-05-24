<?php
use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;
$form=new LoginForm;
if($form->validate($_POST["email"],$_POST["password"])){
    $auth=new Authenticator();
    if($auth->attempt($_POST["email"],$_POST["password"])){
        redirect("/");  
    }
    $form->addError("login","If you're a person who misprinted/forgot their password/email , try again! "."<br>"."If you're a hacker or a bot,  there's nothing to hack for you :(");
};
Session::makeFlash("errors",$form->getErrors());
redirect("/login");
// view("sessions/create.view.php",[
//     "errors"=>$form->getErrors()
// ]);


