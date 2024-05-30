<?php
use Core\App;
use Core\Session;
use Http\EditRating;
$db=App::resolve("Core\Database");
$auth= Session::get("user")["id"];
$answer_id=$_POST["answer_id"];
if($auth==NULL){
    redirect("/answer?id=$answer_id");
} 
$opinion=$db->query("SELECT * FROM `ratingAnswersActions` WHERE `user_id` = :user_id AND `answer_id` = :answer_id",[
    "user_id"=>Session::get("user")["id"],
    "answer_id"=>$answer_id
])->find()["opinion"];
$oldRating=$db->query("SELECT * FROM `answers` WHERE `id` = :id",[
    "id"=>$answer_id
])->find()["rating"];
$edit=new editRating([
    "oldOpinion"=>$opinion,
    "newOpinion"=>$_POST["opinion"],
    "db"=>$db,
    "itemsTable"=>"answers",
    "answer_id"=>$answer_id,
    "oldRating"=>$oldRating,
    "ratingActions"=>"ratingAnswersActions",
    "user_id"=>Session::get("user")["id"],
    "item"=>"answer"
]);
$edit->edit();
redirect("/answer?id=$answer_id");