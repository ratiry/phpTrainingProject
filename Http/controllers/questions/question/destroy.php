<?php
use Core\Session;
use Core\App;

if($_POST["user_id"]!=Session::get("user")["id"]){
  redirect("/questions");
}
$db=App::resolve("Core\Database");
$db->query("DELETE FROM `questions` WHERE `id`=:id",[
  "id"=>$_POST["question_id"]
]);
redirect("/questions");
