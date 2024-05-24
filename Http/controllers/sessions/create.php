<?php
use Core\Session;
view("sessions/create.view.php",[
    "heading"=>"Log in",
    "errors"=>Session::get("errors")
]);