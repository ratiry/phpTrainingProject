<?php
use Core\App;
use Core\Session;
use Http\EditRating;
$db=App::resolve("Core\Database");
$auth= Session::get("user")["id"];
$question_id=$_POST["question_id"];
if($auth==NULL){
    redirect("/question?id=$question_id");
} 
$opinion=$db->query("SELECT * FROM `ratingQuestionsActions` WHERE `user_id` = :user_id AND `question_id` = :question_id",[
    "user_id"=>Session::get("user")["id"],
    "question_id"=>$question_id
])->find()["opinion"];
$oldRating=$db->query("SELECT * FROM `questions` WHERE `id` = :id",[
    "id"=>$question_id
])->find()["rating"];
$edit=new editRating([
    "oldOpinion"=>$opinion,
    "newOpinion"=>$_POST["opinion"],
    "db"=>$db,
    "itemsTable"=>"questions",
    "question_id"=>$question_id,
    "oldRating"=>$oldRating,
    "ratingActions"=>"ratingQuestionsActions",
    "user_id"=>Session::get("user")["id"],
    "item_id"=>"question_id"
]);
$edit->edit();
redirect("/question?id=$question_id");