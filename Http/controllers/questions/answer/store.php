<?php
use Http\Forms\AnswerForm;
use Core\App;
use Core\Session;

$db=App::resolve("Core\Database");
AnswerForm::validate([
    "body"=>$_POST["body"]
]);

$db->query("INSERT INTO `answers` (`id`, `user_id`, `question_id`, `body`,`rating`) VALUES (NULL, :user_id, :question_id, :body, 0)",[
    "user_id"=>Session::get("user")["id"],
    "question_id"=>$_POST["question_id"],
    "body"=>$_POST["body"]
]);

redirect("/question?id=".$_POST["question_id"]);