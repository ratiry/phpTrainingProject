<?php
use Core\Database;
$config = require base_path('config.php');
$db = new Database($config['database']);
if($_SERVER["REQUEST_METHOD"]=="POST"){
  dd($_POST);
}
$currentUserId = 1;

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();
print_r(($note["user_id"])===($currentUserId));
authorize(($note["user_id"]+1)!==($currentUserId+1));

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);