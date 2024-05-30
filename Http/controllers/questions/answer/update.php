<?php
use Http\Forms\AnswerForm;
use Core\App;
use Core\Router;
$router=new Router;
$question_id=$_POST["question_id"];
$db=App::resolve("Core\Database");
AnswerForm::validate([
  "body"=>$_POST["body"]
]);

$db->query("UPDATE answers SET body = :body WHERE `answers`.`id` = :id",[
  "body"=>$_POST["body"],
  "id"=>$_POST["answer_id"]
]);
redirect("/question?id=$question_id");