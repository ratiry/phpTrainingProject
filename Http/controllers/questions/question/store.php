<?php
use Http\Forms\QuestionForm;
$form=QuestionForm::validate([
  "title"=>$_POST["title"],
  "body"=>$_POST["body"]
]);
dd($form);