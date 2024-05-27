<?php
use Core\App;
use Http\Forms\SortFilterForm;
use Core\Session;
$db=App::resolve("Core\Database");
$sortFilter="";

if($_GET!=NULL){
  $sortFilter= SortFilterForm::compile($_GET["filter"],$_GET["sort"],Session::get("user")["id"]);
}
$questions=$db->query("SELECT * FROM `questions` $sortFilter")->get();
view("questions/index.view.php",[
  "heading"=>"questions",
  "db"=>$db,
  "questions"=>$questions
]
);