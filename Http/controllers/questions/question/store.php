<?php
use Http\Forms\QuestionForm;
use Core\App;
use Core\Session;
$form=QuestionForm::validate([
  "title"=>$_POST["title"],
  "body"=>$_POST["body"]
]);
$db=App::resolve("Core\Database");
$db->query("INSERT INTO `questions` (`id`, `title`, `body`, `rating`, `category`, `user_id`) VALUES (NULL, :title, :body, '0', :category, :user_id);",[
  "title"=>$_POST["title"],
  "body"=>$_POST["body"],
  "category"=>$_POST["category"],
  "user_id"=>Session::get("user")["id"]
]);
return redirect("/questions");