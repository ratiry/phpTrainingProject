<?php
use Core\App;
$db=App::resolve("Core\Database");
$question_id=$_POST["question_id"];
$db->query("DELETE FROM answers WHERE id=:id",[
  "id"=>$_POST["answer_id"]
]);
redirect("/question?id=$question_id");