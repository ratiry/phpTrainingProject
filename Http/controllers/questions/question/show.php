<?php
use Core\App;
use Core\Session;
use Http\Forms\SortFilterForm;
$db=App::resolve("Core\Database");
$user_id=Session::get("user")["id"];
$sortFilter="";
$question=$db->query('select * from questions where id = :id', [
  'id' => $_GET['id']])->findOrFail();
$user_name=$db->query('select * from users where id = :id', [
  'id' => $question['user_id']])->find()["name"];
$opinion=$db->query("SELECT * FROM `ratingQuestionsActions` WHERE `user_id` = :user_id AND `question_id` = :question_id",[
  "user_id"=>$user_id,
  "question_id"=>$question["id"]
])->find()["opinion"];
if($_GET["sort"]!=NULL || $_GET["filter"]!=NULL){
  $sortFilter=SortFilterForm::compile($_GET["filter"],$_GET["sort"],$user_id);
}
$answers=$db->query("SELECT * FROM `answers` WHERE `question_id` = :question_id $sortFilter",[
  "question_id"=>$question["id"]
])->get();


$userAlreadyAnswered=False;
$usersAnswersOpinions=[];
$authorsOfAnswers=[];
foreach($answers as $answer){
  $authorsOfAnswers[]=$db->query("SELECT * FROM `users` WHERE `id` = :user_id  " ,[
  "user_id"=>$answer["user_id"]
])->get();
  $usersAnswersOpinions[]=$db->query("SELECT `opinion` FROM `ratingAnswersActions` WHERE `user_id` = :user_id AND `answer_id` = :answer_id",[
    "user_id"=>$user_id,
    "answer_id"=>$answer["id"]
  ])->find();
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
  "userAlreadyAnswered"=>$userAlreadyAnswered,
  "usersAnswersOpinions"=>$usersAnswersOpinions,
  "authorsOfAnswers"=>$authorsOfAnswers
]);
