<?php
use Core\App;
$db=App::resolve("Core\Database");
$question=$db->query('select * from questions where id = :id', [
  'id' => $_GET['id']])->findOrFail();
$user_name=$db->query('select * from users where id = :id', [
  'id' => $question['user_id']])->find()["name"];
view("/questions/question/show.view.php",[
  "heading"=>"question",
  "question"=>$question,
  "user_name"=>$user_name
]);
