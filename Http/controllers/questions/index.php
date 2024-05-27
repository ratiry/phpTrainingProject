<?php
use Core\App;
$db=App::resolve("Core\Database");
$questions=$db->query("SELECT * FROM `questions`")->get();
view("questions/index.view.php",[
  "heading"=>"questions",
  "db"=>$db,
  "questions"=>$questions
]
);