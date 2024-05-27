<?php
use Core\Session;
view("questions/question/create.view.php",[
  "heading"=>"ask a question",
  "errors"=>Session::get("errors")
]);