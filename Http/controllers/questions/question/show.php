<?php
use Core\App;
use Core\Session;
$db=App::resolve("Core\Database");
$user_id=Session::get("user")["id"];
$question=$db->query('select * from questions where id = :id', [
  'id' => $_GET['id']])->findOrFail();
$user_name=$db->query('select * from users where id = :id', [
  'id' => $question['user_id']])->find()["name"];
$opinion=$db->query("SELECT * FROM `ratingQuestionsActions` WHERE `user_id` = :user_id AND `question_id` = :question_id",[
  "user_id"=>$user_id,
  "question_id"=>$question["id"]
])->find()["opinion"];
$answers=$db->query("SELECT * FROM `answers` WHERE `question_id` = :question_id",[
  "question_id"=>$question["id"]
])->get();
$userAlreadyAnswered=False;
foreach($answers as $answer){
  if($answer["user_id"]==$user_id){
    $userAlreadyAnswered=True;
    break;
  }
}
view("/questions/question/show.view.php",[
  "heading"=>"question",
  "question"=>$question,
  "user_name"=>$user_name,
  "opinion"=>$opinion,
  "user_id"=>$user_id,
  "errors"=>Session::get("errors"),
  "answers"=>$answers,
  "userAlreadyAnswered"=>$userAlreadyAnswered
]);
