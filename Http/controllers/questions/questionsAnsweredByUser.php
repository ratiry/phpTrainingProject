<?php
use Core\App;
use Core\Session;
$user_id=Session::get("user")["id"];
$db=App::resolve("Core\Database");
$answers=$db->query("SELECT `question_id` FROM `answers`WHERE `user_id`= :user_id",[
  "user_id"=>$user_id
])->get();
$questions=[];
foreach($answers as $key=>$value){
  $questions[]=$db->query("SELECT * FROM `questions` WHERE id=:question_id",[
  "question_id"=>$answers[$key]["question_id"]
  ])->find();

}
view("questions/index.view.php",[
  "heading"=>"unAnswered questions",
  "db"=>$db,
  "questions"=>$questions,
  "id"=>Session::get("user")["id"],
]);