<?php
use Core\App;
use Core\Validator;
$db=App::resolve("Core\Database");

$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();
authorize(($note["user_id"]+1)!==($currentUserId+1));
$errors = [];
if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}
if (empty($errors)) {
    $db->query('UPDATE `notes` SET `body` = :body WHERE `notes`.`id` = :id; ', [
        'body' => $_POST['body'],
        'id' => $_POST["id"]
    ]);
    header("location: /notes");
    die();
}else{
    return view("notes/edit.view.php",[
        "heading"=>"Edit Note",
        "errors"=>$errors,
        "note"=>$note
    ]);
}
