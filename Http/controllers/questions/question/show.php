<?php
use Core\App;
use Core\Session;
$db=App::resolve("Core\Database");
$question=$db->query('select * from questions where id = :id', [
  'id' => $_GET['id']])->findOrFail();
$user_name=$db->query('select * from users where id = :id', [
  'id' => $question['user_id']])->find()["name"];
$opinion=$db->query("SELECT * FROM `ratingActions` WHERE `user_id` = :user_id AND `question_id` = :question_id",[
  "user_id"=>Session::get("user")["id"],
  "question_id"=>$question["id"]
])->find()["opinion"];
$answers=$db->query("SELECT * FROM `answers` WHERE `question_id` = :question_id",[
  "question_id"=>$question["id"]
])->get();
view("/questions/question/show.view.php",[
  "heading"=>"question",
  "question"=>$question,
  "user_name"=>$user_name,
  "opinion"=>$opinion,
  "user_id"=>Session::get("user")["id"],
  "errors"=>Session::get("errors"),
  "answers"=>$answers
]);
