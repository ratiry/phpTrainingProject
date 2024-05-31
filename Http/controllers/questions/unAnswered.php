<?php
use Core\App;
use Core\Session;
$db=App::resolve("Core\Database");
$answers=$db->query("SELECT `question_id` FROM `answers`")->get();
$questions=$db->query("SELECT * FROM `questions`")->get();
foreach($questions as $key=>$value){
  $isAnswered=False;
  foreach($answers as $key2=>$value){
    if($answers[$key2]["question_id"]==$questions[$key]["id"]){
      $isAnswered=True;
    }
  }
  if($isAnswered){
    unset($questions[$key]);
  }
}
view("questions/index.view.php",[
  "heading"=>"unAnswered questions",
  "db"=>$db,
  "questions"=>$questions,
  "id"=>Session::get("user")["id"],
]);