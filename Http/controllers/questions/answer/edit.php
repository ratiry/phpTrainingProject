<?php
use Core\App;
use Core\Session;
$errors=Session::get("errors");
$db=App::resolve("Core\Database");
view("questions/answer/edit.view.php",[
  "errors"=>$errors,
  "answer_id"=>$_GET["answer_id"],
  "question_id"=>$_GET["question_id"]
]);